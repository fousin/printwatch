<?php
namespace App\Http\Controllers;

use Exception;
use OnurKose\SNMPWrapper\SNMPWrapper;


class SnmpController extends Controller {

    public function atualizaToners($printers, $oids, $modelos, $tonersBd){
        $snmp = new SNMPWrapper();
        $valorToner = array();
        foreach($printers as $printer){
            $oidModelo = $oids->firstWhere('modelo_id', $printer->modelo_id);
            $modeloTonerPrinter = $modelos->firstWhere('marca_id', $printer->marca_id);
            $snmp->setHost($printer->ip, 'public');

            if($modeloTonerPrinter->toner == 'mono'){

                try{
                    $valorToner = $snmp->get($oidModelo->oidTonerMonocromatico);
                    $percentTonerMonocromatico = $valorToner['.'.$oidModelo->oidTonerMonocromatico]/150;
                }catch(Exception $e){
                    $percentTonerMonocromatico = 0;
                }
                
                $tonerPrinterAtual = $tonersBd->where('printer_id', $printer->id)->where('cor','monocromatico')->first(); 
                $data['volumeAtual'] = $percentTonerMonocromatico;
                //atualiza volume do toner monocromatico
                $tonerPrinterAtual->update($data);

                try{
                    $valorUnidade = $snmp->get($oidModelo->oidUnidadeImagem);
                    $percentUnidade = $valorUnidade['.'.$oidModelo->oidUnidadeImagem]/300;
                }catch(Exception $e){
                    $percentUnidade = 0;
                }
                
                $unidadePrinterAtual = $tonersBd->where('printer_id', $printer->id)->where('cor','unidade')->first(); 
                $data['volumeAtual'] = $percentUnidade;

                //atualiza volume da unidade de imagem
                $unidadePrinterAtual->update($data);

                try{
                    $valorTotalPaginas = $snmp->get($oidModelo->oidContadorPagina);
                    $totalPaginas['contador_paginas'] = $valorTotalPaginas['.'.$oidModelo->oidContadorPagina];
                }catch(Exception $e){
                    $totalPaginas['contador_paginas'] = 0;
                }
                $printer->update($totalPaginas);
                

            }else{
                try{
                    $valorToner['preto'] = $snmp->get($oidModelo->oidTonerPreto)['.'.$oidModelo->oidTonerPreto];
                    $valorToner['ciano'] = $snmp->get($oidModelo->oidTonerCiano)['.'.$oidModelo->oidTonerCiano];
                    $valorToner['magenta'] = $snmp->get($oidModelo->oidTonerMagenta)['.'.$oidModelo->oidTonerMagenta];
                    $valorToner['amarelo'] = $snmp->get($oidModelo->oidTonerAmarelo)['.'.$oidModelo->oidTonerAmarelo];
                }catch(Exception $e){
                    $valorToner['preto'] = 0;
                    $valorToner['ciano'] = 0;
                    $valorToner['magenta'] = 0;
                    $valorToner['amarelo'] = 0;
                }

                $tonersPrinterAtual = $tonersBd->where('printer_id', $printer->id);

                foreach($tonersPrinterAtual as $tonerPrinterAtual){
                    $valorAtual['volumeAtual'] = $valorToner[$tonerPrinterAtual->cor];
                    $tonerPrinterAtual->update($valorAtual);
                }

                //tambor
                //$valorUnidade = $snmp->get($oidModelo->oidTamborImagem)['.'.$oidModelo->oidTamborImagem];
                
                try{
                    $valorTotalPaginas = $snmp->get($oidModelo->oidContadorPagina)['.'.$oidModelo->oidContadorPagina];
                }catch(Exception $e){
                    $valorTotalPaginas = 0;
                }
                

            }



        }
            

    }
}