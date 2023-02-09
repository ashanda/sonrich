<?php
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
Use App\Models\cash_wallet;
Use App\Models\shadow_map;
Use App\Models\daily_commission_log;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\level_commission_log;
use App\Models\product_wallet;
use App\Models\oder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


 function getCountryList(){
    $countries = CountryListFacade::getList('en');
     return $countries;
 } 

 function get_user_kyc(){
    if(Auth::user()->role == 2 || Auth::user()->role == 1){
        $kyc = Kyc::all();
    }else{
        $kyc = Kyc::where('user_id', Auth::user()->id)->get();
    }
    
    return $kyc;
 }

function user_product_count(){
    $user_data = DB::table('user_oder_counts')->where('user_id',Auth::user()->id)->get();
    $user_count = $user_data->count();
    return $user_count;
}

function product_wallet_balance(){
    $product_wallet_balance_data = DB::table('product_wallets')->where('user_id',Auth::user()->id)->first();
    if($product_wallet_balance_data != NULL){
        $product_wallet_balance = $product_wallet_balance_data->wallet_balance;
    }else{
        $product_wallet_balance = 0;
    }
    return $product_wallet_balance;
}

function binary_total(){
    $sum = binary_commission_log::where('user_id', Auth::user()->id)->sum('amount');
    return $sum;
}

function level_total(){
    $sum = level_commission_log::where('user_id', Auth::user()->id)->sum('amount');
    return $sum;
}

function daily_total(){
    $sum = daily_commission_log::where('user_id', Auth::user()->id)->sum('amount');
    return $sum;
}

function direct_total(){
    $sum = direct_commission_log::where('user_id', Auth::user()->id)->sum('amount');
    return $sum;
}

function globle_send_mail($html)
{

  
  $plain = "This email is automatically generated by the sonrich system. Please do not reply to this email" ;
  $to = Auth::user()->email ;
  $subject= 'Sonrich Product Buy';
  $formEmail = 'support@sonrich.com' ;
  $formName = 'SONRICH';

  Mail::send([], [], function($message) use($html, $plain, $to, $subject, $formEmail, $formName){
    $message->from($formEmail, $formName);
    $message->to($to);
    $message->subject($subject);
    $message->setBody($html, 'text/html' ); // dont miss the '<html></html>' or your spam score will increase !
    $message->addPart($plain, 'text/plain');
});


}


function geneology( $target_parent){

 
 
  $parent_details = DB::table("users")
                  ->where("users.id", "=", $target_parent) 
                  ->get();
  
  if($parent_details->isEmpty()){
    echo '
    <div class="alert alert-warning" role="alert">
     <strong>Warning!</strong> No Geneology Found.
    </div>';
    
  }else{
echo "
    
        <li class='current_parent'>
    <a  title='User Details'>
    
                  
                  <span class='geneology_child_info'>
                    <lable>User id - ".$parent_details[0]->id." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                  <lable>Name - ".$parent_details[0]->fname." ".$parent_details[0]->lname." </lable>
                </span><br/>                
                  <span class='geneology_child_info'>
                    <lable>Registered Date - ".$parent_details[0]->created_at." </lable>
                  </span><br/>
                  </a>
               
    </a>";
            
    $parent_node_id = DB::table('shadow_maps')->where('user_id',$target_parent)->get();
    $geneology = DB::table('users')
    ->join('shadow_maps', 'shadow_maps.user_id', '=', 'users.id')
    ->where('shadow_maps.parent_node','=' ,$parent_node_id[0]->id)
    ->select('shadow_maps.user_id','shadow_maps.status','users.fname','users.lname', "users.email",'shadow_maps.reference_node_side' , 'users.fname' , 'users.email' , 'users.created_at')
    ->get();
    if($geneology->isEmpty()){
      echo '
      <div class="alert alert-warning" role="alert">
          End of the Line.
      </div>';
    }
$child_elements='';  
$left_child='';
$right_child='';        
    if(count($geneology)>0){
      echo '<ul>';
     
        foreach($geneology as $geneology_data){
          if($geneology_data->status == 0){
                $active = 'deactive';
          }else{
                $active = 'active';
          }
            
            if($geneology_data->reference_node_side == 0){
              $left_child = 
              "<li class='left_child ".$active."'>
                  <a href='/genealogy/?parent=".base64_encode($geneology_data->user_id)."' title='User Details'>
                  <span class='geneology_child_info'>
                    <lable>User id - ".$geneology_data->user_id." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>Name - ".$geneology_data->fname." ".$geneology_data->lname." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>Registered Date - ".$geneology_data->created_at." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>User Side - LEFT </lable>
                  </span><br/>
                  </a>
                </li>";
            }else{
              $right_child = 
              "<li class='right_child ".$active."'>
                  <a href='/genealogy/?parent=".base64_encode($geneology_data->user_id)."' title='User Details'>
                  <span class='geneology_child_info'>
                    <lable>User id - ".$geneology_data->user_id." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>Name - ".$geneology_data->fname." ".$geneology_data->lname." </lable>
                  </span><br/>
                  
                  <span class='geneology_child_info'>
                    <lable>Registered Date - ".$geneology_data->created_at." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>User Side - RIGHT </lable>
                  </span><br/>
                  </a>
                </li>";;
            }

          }
          if($left_child != ''){
            
            echo $left_child;
          }
          if($right_child != ''){
            
            echo $right_child;
          }
          
        
    }
    echo '</ul>
    </li>
                            
    
  ';
  }//end kyc check
  
}
  
// All Master Data

function master_data(){
    $master_data = DB::table('master')->first();
    return $master_data;
}

// product wallet log
function product_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description){
  $product_wallet_log = DB::table('product_wallet_logs')->insert(
    ['user_id' => $user_id, 'amount' => $amount, 'oder_id' => $oder_id,'reference_oder_id' => $reference_oder_id,'trx_direction' => $trx_direction ,'description'=> $description]
  );
}

// cash wallet log
function cash_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description){
  $cash_wallet_log = DB::table('cash_wallet_logs')->insert(
    ['user_id' => $user_id, 'amount' => $amount, 'oder_id' => $oder_id,'reference_oder_id' => $reference_oder_id,'trx_direction' => $trx_direction ,'description'=> $description]
  );
}

//cash Wallet Update
function cash_wallet($user_id){
  $cash_wallet = DB::table('cash_wallets')->where('user_id',$user_id)->first(); 
 
  return $cash_wallet;

}

//product wallet Update
function product_wallet(){
  $product_wallet = DB::table('product_wallets')->where('user_id',Auth::user()->id)->first();
  return $product_wallet;

}

//user oder count
function user_oder_count($user_id){
  $user_oder_count = DB::table('user_oder_counts')->where('user_id',$user_id)->first();
  return $user_oder_count->count;
}

//cash wallet Update
function cash_wallet_update($amount,$current_user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill){

  if($spill == 1){
    $store_amount = $amount;

    if($old_cash_wallet == NULL){
      $update_cash_wallet = cash_wallet::updateOrInsert(
        ['user_id' => $current_user_id],
        ['wallet_balance' => $store_amount]
       );
    }else{
      $update_cash_wallet = cash_wallet::updateOrInsert(
        ['user_id' => $current_user_id],
        ['wallet_balance' => $old_cash_wallet->wallet_balance + $store_amount]
       );
    }
  }else{

    $store_amount = (2/3) * $amount;

      if($old_cash_wallet == NULL){
        $update_cash_wallet = cash_wallet::updateOrInsert(
          ['user_id' => $current_user_id],
          ['wallet_balance' => $store_amount]
        );
      }else{
        $update_cash_wallet = cash_wallet::updateOrInsert(
          ['user_id' => $current_user_id],
          ['wallet_balance' => $old_cash_wallet->wallet_balance + $store_amount]
        );
      }

  }
  

  
  
    
    $trx_direction = 'IN';
    

    

  cash_wallet_log($current_user_id,$amount,$currentorderid,$reference_oder_id,$trx_direction,$description);

  return $update_cash_wallet;
}

///product wallet Update
function product_wallet_update($amount,$current_user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill){

  if($spill == 1){

    $store_amount = $amount;
    if($old_product_wallet == NULL){
      $update_product_wallet = product_wallet::updateOrInsert(
        ['user_id' => $current_user_id],
        ['wallet_balance' => $store_amount]
      );
    }else{
      $update_product_wallet = product_wallet::updateOrInsert(
        ['user_id' => $current_user_id],
        ['wallet_balance' => $old_product_wallet->wallet_balance + $store_amount]
      );
    }

  }else{

    $store_amount = (1/3) * $amount;
    if($old_product_wallet == NULL){
      $update_product_wallet = product_wallet::updateOrInsert(
        ['user_id' => $current_user_id],
        ['wallet_balance' => $store_amount]
      );
    }else{
      $update_product_wallet = product_wallet::updateOrInsert(
        ['user_id' => $current_user_id],
        ['wallet_balance' => $old_product_wallet->wallet_balance + $store_amount]
      );
    }
  }

 
  



    $trx_direction = 'IN';
    $description = '1/3 Binary commission';

    product_wallet_log($current_user_id,$amount,$currentorderid,$reference_oder_id,$trx_direction,$description);

  return $update_product_wallet;
}


//shadow map parent node check

function shadow_map_parent_node_check($child_id){
  $nodeparent_map = shadow_map::where('user_id', $child_id)->first();

  return $nodeparent_map;
}

//shadow map nodes activation check

function shadow_map_node_check($user_id){
  $shadow_map_node_check = shadow_map::where('user_id', $user_id)->where('status',1)->first();

  return $shadow_map_node_check;
}

//user current active package 
function current_user_active_package(){
  $current_user_active_package = DB::table("oders")
  ->Join('products','oders.product_id','=','products.id')
  ->where("oders.status", "=", 1)
  ->where("oders.user_id", "=", auth::user()->id)
  ->first();
  
  return $current_user_active_package;
}

//user active package count 
function current_user_active_package_count(){
  $current_user_active_package_count = DB::table("oders")
  ->Join('products','oders.product_id','=','products.id')
  ->where("oders.status", "=", 1)
  ->where("oders.user_id", "=", auth::user()->id)
  ->count();
  
  return $current_user_active_package_count;
}

//user oder count update 
function user_oder_count_update($user_id,$oder_id){
  $oder_counts_detils = DB::table('user_oder_counts')->where('user_id', $user_id)->first();
        if($oder_counts_detils != NULL){
            $oder_counts_detils->count;
            $oder_count = $oder_counts_detils->count;
        }else{
            $oder_count = 0;
        }
        
        
        
         $oder_counts = DB::table('user_oder_counts')->updateOrInsert(
                        ['user_id'=>$user_id],
                        ['oder_id'=> $oder_id,
                        'count'=>$oder_count+1]);
}


// admin 7 head check 

function admin_head_check($user_node_id){
  if($user_node_id == 1 || $user_node_id == 2 || $user_node_id == 3 || $user_node_id == 4 || $user_node_id == 5 || $user_node_id == 6 || $user_node_id == 7 ){

    return 1;
  }else{

    return 0;
  }
}


// admin and other 6 gas fee collect
function gas_fee_collect(){
  

$data = DB::table("oders")

->whereIn("user_id", [2, 3, 4, 5, 6, 7, 8])
->join('users','users.id', '=', 'oders.user_id')
->whereColumn("max_value", "<", 'total_package_earnings')
->get();

return $data;
}


function find_product($product_id){
  $product_data = DB::table('products')->where('id',$product_id)->first();
  
  return $product_data;
}

function binary_point($user_id){
  $binary_point = DB::table('binary_commissions')->where('user_id',$user_id)->first();
  return $binary_point;
}

function user_data_get($user_id){
  $user_data = DB::table('users')->where('id',$user_id)->first();
  return $user_data;
}

function spilled_package($user){
  $check_oder_data = DB::table('oders')->where('user_id',$user)->where('status',2)->first();
  return $check_oder_data;
}

