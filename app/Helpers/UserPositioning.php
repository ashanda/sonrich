<?php 
/*
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
use App\Models\shadow_map_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


function user_positioning(){

$i=0;
$relative_level = $i;
$parent_level_nodes = array();
$current_level_nodes = array(); 
$current_level_map = shadow_map_model::where('virtual_level', $i)->first();

while( $i == count ( $parent_level_nodes ) ){

$current_node = $parent_level_nodes[$i];

$current_maps = shadow_map::where('parent_node',$current_new)->first();
$user_id = $current_maps->user_id;
//always has two elements
for( $j=1; $j<2; $j++ ){
$current_level_nodes.addelement[$current_maps[$j]  ];
}

//re arrange
$a=0;
foreach ($current_level_map_model as $map_node ){
$rearranged_current_level_map[ a ] = $current_level_nodes[ map_node ] ;
$a++;
}

foreach ($rearranged_current_level_map as $level_node ){
    $current_maps = shadow_map::where('parent_node',$current_new)->first();

if ( (select status from shadow_map where id= level_node ) == 0 )
{  return node;  }
}
$i++;
}

}
return

*/