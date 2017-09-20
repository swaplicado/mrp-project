<?php
//\Config::get('scwms.MVT_CLS_IN')

return [

    'MVT_CLS_IN' => '1', //
    'MVT_CLS_OUT' => '2',

    'MVT_TP_IN_SAL' => '1',
    'MVT_TP_IN_PUR' => '2',
    'MVT_TP_IN_ADJ' => '3',
    'MVT_TP_IN_TRA' => '4', // transfer (traspaso)
    'MVT_TP_IN_CON' => '5', // conversion
    'MVT_TP_IN_PRO' => '6', // production
    'MVT_TP_IN_EXP' => '7', // expenses
    'MVT_TP_OUT_SAL' => '1',
    'MVT_TP_OUT_PUR' => '2',
    'MVT_TP_OUT_ADJ' => '3',
    'MVT_TP_OUT_TRA' => '4',
    'MVT_TP_OUT_CON' => '5',
    'MVT_TP_OUT_PRO' => '6',
    'MVT_TP_OUT_EXP' => '7',

    // applies only for sales and purchases
    'MVT_SPT_TP_STK_RET' => '1', // supply (surtido) and return
    'MVT_SPT_TP_CHA' => '2', // change
    'MVT_SPT_TP_WAR' => '3', // warranty
    'MVT_SPT_TP_CON' => '4', // consignment

    // applies only for production
    'MVT_MFG_TP_MAT' => '1', // materials
    'MVT_MFG_TP_PRO' => '2', // products

    // applies only for adjustments
    'MVT_ADJ_TP_IFI' => '1', // initial and final inventory
    'MVT_ADJ_TP_DIS' => '2', // discrepancy
    'MVT_ADJ_TP_MAL' => '3', // malfunction
    'MVT_ADJ_TP_OBS' => '4', // obsolescence
    'MVT_ADJ_TP_EXP' => '5', // expiration
    'MVT_ADJ_TP_DAM' => '6', // damage
    'MVT_ADJ_TP_COM' => '7', // commercial sample
    'MVT_ADJ_TP_PRO' => '8', // promotional sample
    'MVT_ADJ_TP_IYD' => '9', // investigation and development
    'MVT_ADJ_TP_LAB' => '10', // laboratory
    'MVT_ADJ_TP_TAS' => '11', // tasting
    'MVT_ADJ_TP_DON' => '12', // donation
    'MVT_ADJ_TP_OTH' => '13', // others

    // applies only for expenses
    'MVT_EXP_TP_PUR' => '1', // purchases
    'MVT_EXP_TP_PRO' => '2', // production

];
