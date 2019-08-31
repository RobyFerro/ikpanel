<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\App\Http\Controllers;

use Exception;
use ikdev\ikpanel\app\Role;
use ikdev\ikpanel\app\Widgets;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class WidgetController extends BaseController
{
    
    //region DASHBOARD
    
    /**
     * Estrazione dei widget legati al proprio ruolo
     * @return mixed
     * @throws Exception
     */
    public function getWidgets()
    {
        $user = Auth::user();
        $role = $user->role;
        
        $widgets = Role::find($role)->widgets;
        
        if (!is_null($widgets)) {
            try {
                $sorted = $widgets
                    ->sortBy(function ($item) {
                        return $item->toArray()['pivot']['order'];
                    })
                    ->groupBy(function ($item) {
                        return $item->toArray()['pivot']['row'];
                    })
                    ->sortBy(function ($item, $key) {
                        return $key;
                    });
                
                return $sorted;
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    
    /**
     * Creazione array omologati per Handlebars
     * @param  string  $table_id
     * @param  array  $th
     * @param  array  $values
     * @return array
     */
    public function makeArrayForTable($table_id, $th, $values)
    {
        $data = [
            "table_id" => $table_id,
            "th" => [],
            "tr" => []
        ];
        
        $thList = explode(',', $th);
        
        foreach ($thList as $th) {
            $array = ['text' => $th];
            
            array_push($data["th"], $array);
        }
        
        foreach ($values as $value) {
            array_push($data["tr"], ["td" => $value]);
        }
        
        return $data;
        
    }
    
    /**
     * Creazione array per grafici
     * @param  string  $type
     * @param  array  $data
     * @param  string  $id
     * @param  array  $labels
     * @param  array  $colors
     * @param  array  $options
     * @param  array  $dataset_labels
     * @return array
     */
    public function makeGraph(
        $type,
        $data,
        $id,
        $labels,
        $colors,
        $options = ['responsive' => true, 'maintainAspectRatio' => false],
        $dataset_labels = null
    ) {
        $data = [
            "type" => $type,
            "data" => $data,
            "graph_id" => $id,
            "labels" => $labels,
            "colors" => $colors,
            "options" => $options,
            "dataset_labels" => $dataset_labels
        ];
        
        return $data;
    }
    
    //endregion
    
    
    //region MODIFICA
    
    /**
     * Carica tutti i widgets
     * @param  int  $id
     * @return array
     */
    public function getAllWidgets()
    {
        $widgets = Widgets::all()->sortBy('name');
        
        $data = [];
        
        foreach ($widgets as $widget) {
            
            $array = [
                "code" => $widget['id'],
                "preset" => true,
                "description" => $widget['name'],
                "type" => "SELECT",
                "custom_label" => false
            ];
            
            array_push($data, $array);
        }
        return $data;
    }
    
    /**
     *  Crea le righe in base alla vista gia' esistente
     * @param  int  $id
     * @return array
     */
    public function getRowsWidgets($id)
    {
        
        $widgets = Role::find($id)->widgets;
        
        $data = [];
        foreach ($widgets as $widget) {
            $row = $widget['pivot']['row'];
            $order = $widget['pivot']['order'];
            
            $data[$row][$order]['span'] = $widget['pivot']['span'];
            $data[$row][$order]['description'] = $widget['name'];
            $data[$row][$order]['code'] = $widget['id'];
        }
        
        ksort($data);
        
        $ordered = collect($data)->map(function ($item) {
            $ord = collect($item)->sortBy(function ($item, $key) {
                return $key;
            });
            return $ord;
        });
        
        return $ordered;
    }
    
    /**
     * Salva l'ordine dei widgets
     * @param  Request  $request
     * @param  int  $id
     */
    public function saveOrder(Request $request, $id)
    {
        $role = Role::find($id);
        
        $data = $request->input('data');
        
        $array = [];
        
        foreach ($data as $row => $items) {
            foreach ($items as $item => $value) {
                
                $order = $item;
                $id = $value['code'];
                $span = $value['span'];
                
                $array[$id] = ['row' => $row, 'span' => $span, 'order' => $order];
            }
        }
        
        $role->widgets()->sync($array);
    }
    
    //endregion
}


