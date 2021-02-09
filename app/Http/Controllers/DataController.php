<?php

namespace App\Http\Controllers;
date_default_timezone_set('America/New_York');

use Illuminate\Http\Request;

class DataController extends Controller
{
    //
    public function getData(Request $request){

        $config = new \PHRETS\Configuration;
        // $config = \PHRETS\Http\Client::set(new \GuzzleHttp\Client);
        $config->setLoginUrl('http://reb.retsiq.com/contactres/rets/login')
            ->setUsername('RETSARVING')
            ->setPassword('wjq6PJqUA45EGU8')
            ->setRetsVersion('1.7.2');
        \PHRETS\Http\Client::set(new \GuzzleHttp\Client);
        $rets = new \PHRETS\Session($config);
        $connect = $rets->Login();

        // $results = $rets->Search(
        //     'Property',
        //     '',
        //    `['Limit' => 3, 'Select' => 'LIST_1,LIST_105,LIST_15,LIST_22,LIST_87,LIST_133,LIST_134']`,
        //     [
        //         'QueryType' => 'DMQL2',
        //         'Count' => 1, // count and records
        //         'Format' => 'COMPACT-DECODED',
        //         'Limit' => 99999999,
        //         'StandardNames' => 0, // give system names
        //     ]
        // );
        $system = $rets->GetSystemMetadata();
        // var_dump($system);
        $resources = $system->getResources();
        return  $resources;
        
        // return var_dump($rets->GetSystemMetadata());
        $results = $rets->Search('Property', 'A', '*', ['Limit' => 3, 'Select' => 'LIST_1,LIST_105,LIST_15,LIST_22,LIST_87,LIST_133,LIST_134']);

        foreach ($results as $r) {
            var_dump($r);
        }
       
    }
}
