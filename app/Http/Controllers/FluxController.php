<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Flux_rss;
use Illuminate\Http\Request;
use SimpleXMLElement;

class FluxController extends Controller
{
    public function getFlux()
    {
        return response()->json(Flux::all(),200);
    }

    public function getOneFlux($id)
    {
        $flux = Flux::find($id);
        if (is_null($flux)) {
            return response()->json(['message'=>'flux non trouvable'],404); 
        }
        return response()->json($flux,200);
    }

    public function addFlux(Request $request,$id)
    {
        $flux = Flux::find($id);
        if (is_null($flux)) {
            return response()->json(['message'=>'flux non trouvable'],404); 
        }
        $flux->titre = $request->titre;
        $flux->description = $request->description;
        $flux->save();
        return response()->json($flux,200);
    }

    public function updateFlux(Request $request, $id)
    {
        $flux = Flux::find($id);
        if (is_null($flux)) {
            return response()->json(['message'=>'flux non trouvable'],404); 
        }
        $flux->update($request->all());
        return response()->json($flux,200);
    }

    public function index_flux() {
        
        $donnees = curl_init();
        curl_setopt($donnees,CURLOPT_URL,"https://www.lemonde.fr/rss/en_continu.xml");
        curl_setopt($donnees,CURLOPT_RETURNTRANSFER,true);
        $contenu = curl_exec($donnees);
        $xml = new SimpleXMLElement($contenu);
        
        foreach ($xml->channel->item as $e) {
            if ($e) {
                $flux = new Flux_rss();
                $flux->titre = $e->title;
                $flux->description = $e->description;
                
                $flux->save();
            }
        
        }
        return response()->json(['message'=>'enregistrement des données du flux dans le db reussie'],200);
        
    }

}
