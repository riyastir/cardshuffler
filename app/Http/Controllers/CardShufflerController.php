<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardShufflerController extends Controller
{
    public function index($numberOfPlayers){
        
        $cardTypes = array('S','H','D','C');
        $cardSet = array();
        for($i=1;$i<=13;$i++){
	        foreach($cardTypes as $c){
		        $cardSet[]=$c."-".$i;
	        }
        }

        $response = $this->shuffleCards($cardSet,$numberOfPlayers);

        return response()->json($response);

    }

    public function shuffleCards($cardSet,$numberOfPlayers){

        /* Find number of CardSets based on numberOfPlayers */
        $numberOfSets = 52/$numberOfPlayers;

        /* Shuffle the Cards */
        shuffle($cardSet);

        /* Seperate the Shuffled Cardset to Number of Players */
        $cards = array_chunk($cardSet,$numberOfSets);

        if(array_map('array_unique',$cards) != $cards){
            return shuffleCards($cardSet);
        }

        return $cards;

    }
}
