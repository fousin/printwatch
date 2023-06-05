<?php
namespace App\Http\Controllers;

use App\Models\ConfigScript;
use App\Models\Modelos;
use App\Models\OidModelo;
use App\Models\Printer;
use App\Models\Tonner;

class SnmpController extends Controller {
    protected $tonner;
    protected $impressorasBd;
    protected $host;//nome ou ip
    protected $configsBd;
    protected $oidModeloBd;
    protected $modeloBd;
    protected $snmpget;

    public function __construct(ConfigScript $config, Printer $impressoras, OidModelo $oidModelo, Tonner $tonner, Modelos $modelos){
        $this->configsBd = $config;
        $this->modeloBd = $modelos;
        $this->impressorasBd = $impressoras;
        $this->oidModeloBd =  $oidModelo;
        $this->tonner = $tonner;
    }

    public function getTonersValue($id){
        $configs = $this->configsBd->first();
        $impressora = $this->impressorasBd->find($id);
        $ipHost = $impressora->ip;
        $modeloImpressora = $impressora->modelo;
        $idModeloImpressora = $this->modeloBd->firstWhere("modelo", $modeloImpressora)->id;
        $oidModelo = $this->oidModeloBd->firstWhere("modelo_id", $idModeloImpressora);
        $oidValido = array();
        $dados = array();

        //estatico 9 campos na tabela id
        for ($i = 1; $i <= 9; $i++) {
            $campo_oid = 'oid'.str_pad($i, 2, "0", STR_PAD_LEFT);
            if (isset($oidModelo->$campo_oid)) {
                array_push($oidValido, $oidModelo->$campo_oid);
            }
        }
        
        foreach($oidValido as $oid){
            $this->snmpget = 'snmpget ' . "-r1 $configs->version " . '-c ' . "$configs->comunity " . "$ipHost " . $oid;
            
            if(!strstr($this->snmpget, "#")){
                if(!strstr($this->snmpget, "&&")){
                    if(!strstr($this->snmpget, "||")){
                        $validation = strpos($this->snmpget, "this->snmpget");
                        if(isset($validation)){
                            $output = shell_exec($this->snmpget);
                        }
                    }
                }
            }

            if($output == "" || $output == null){
                $output = 1;
            }else{
                $output = explode(":",$output);
            }

            if (isset($output[1])){
                $output[1] = str_replace("\n", "", $output[1]);
                $output[1] = str_replace(" ", "", $output[1]);
                array_push($dados, $output[1]);
            }else{
                array_push($dados, $output);
            }
            
        }
        return $dados; 
    }
}