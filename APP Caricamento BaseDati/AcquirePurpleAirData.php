<?php

/**
* This Software is released under
* GNU General Public License v3.0
*
* Permissions of this strong copyleft license are conditioned on making available 
* complete source code of licensed works and modifications, which include larger
* works using a licensed work, under the same license. 
* Copyright and license notices must be preserved. 
* Contributors provide an express grant of patent rights.
* 
* Author:  pricciardi
* Created: 20 nov 2018
* Last Update: 04/07/2019
*/

require_once 'errorLog.php';
ini_set("error_reporting","on");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

$config = include('./config.php'); 

// Configuro il logger.
$LOG->setLogger
(
    array
    (
        'logger'    => 'FileErrorLog',
        'file'      => './APAD.log',
        'append'    => 'true',
        'to_screen' => 'false',
        'log_level' => LOG_LEVEL_DEBUG
    )
);


$LOG->info('Batch in esecuzione');

$conn = new mysqli($config['host'], $config['username'],  $config['password'],$config['database']);      

// Check connection
if ($conn->connect_error) 
{
   $LOG->fatal($conn->connect_error);
   die("Connection failed");
}
else
{
    $LOG->info('Connected successfully');


    $res = CallAPI("GET", $config['tracciatoJsonSintetico'], "");
    $jsonRecord = json_decode($res);

    $versioneTracciato = $jsonRecord->version;
    $versioneProgramma = $config['versioneTracciato']; 

    if ( $versioneProgramma == $versioneTracciato)     
     {
        // Se il tracciato record è quello atteso inizio ad elaborare i dati per passarli nella tabella 
        // mysql del sito.

         foreach($jsonRecord->data as $record)
         {
             
             if ($record[0] == $config['idSensore1'])
             {
                 //Se è il sensore della Patrimonio inserisco il record nella base dati
                 //N.B. Il paramentro in configurazione sarà trasformato in vettore per poter 
                 //     gestire anche altri eventuali sensori futuri... Quindi la if sarà modificata
                 //     per inserire tutti i sensori presenti nel vettore dei sensori della Patrimonio

                 //non sarebbe necessario farlo, ma anche per trenere traccia della relazione 
                 //posizione/campo passo i campi dell'array in variabili di appoggio 
                $idSensore = $record[0];
                //echo("id SENSORE: ". $idSensore);
                $tspid = $record[1];
                $pm = $record[2];;
                $age = $record[3];;
                $pm_0 = $record[4];;
                $pm_1 = $record[5];;
                $pm_2 = $record[6];;
                $pm_3 = $record[7];;
                $pm_4 = $record[8];;
                $pm_5 = $record[9];;
                $pm_6 = $record[10];;
                $conf = $record[11];;
                $pm1 = $record[12];;
                $pm_10 = $record[13];;
                $p1 = $record[14];;
                $p2 = $record[15];;
                $p3 = $record[16];;
                $p4 = $record[17];;
                $p5 = $record[18];;
                $p6 = $record[19];;
                $humidity = $record[20];;
                $temperature = $record[21];;
                $pressure = $record[22];;
                $rating = $record[28];;

                $sqlInsert =    "INSERT INTO PP_DATI_SENSORI ".  
                                "(ID_SENSORE, TSPID, pm, age, pm_0, ".               
                                "pm_1, pm_2, pm_3, pm_4, pm_5, pm_6, ".               
                                "conf, pm1, pm_10, p1, p2, p3, p4, ".                 
                                "p5, p6, Humidity, Temperature, Pressure, ".           
                                "Rating)".
                                "VALUES ".
                                "('$idSensore', '$tspid', '$pm', '$age', '$pm_0', " .
                                "'$pm_1', '$pm_2', '$pm_3', '$pm_4', '$pm_5', '$pm_6', ".
                                "'$conf', '$pm1', '$pm_10', '$p1', '$p2', '$p3', '$p4', ".
                                "'$p5', '$p6', '$humidity', '$temperature', '$pressure', ".
                                "'$rating')";
                $stmt = $conn->prepare($sqlInsert);
                $stmt->execute();
                $stmt->close();
                break;
             }
         }
    }
    else
    {

        //verificare se mail già mandata, solo se nella giornata non è stata
        //mandata va spedita, altrimenti si salta
        $nomeFile = date("d_m_Y").".ctl";
        if(!(file_exists( $nomeFile )))
        {
            //Creo il file di controllo che impedisce indica che la mail è già stata inviata
            $fileHandle = fopen($nomeFile, 'w');
            fclose($fileHandle);

            //invio la mail
            $to      = $config['alertMailTo'];
            $subject = $config['alertMailSubject'];
            $message = 'Il tracciato dati per cui è stato scritto il programma di caricamento ' .
                       'dei dati del sensore deve essere nella versione' . $config['versioneTracciato'] . ' ' .
                       'tuttavia purpleair ha cambiato la versione del tracciato in ' .$jsonRecord->version . '.' .
                       'Questo potrebbe compromettere il funzionamento dell\'applicazione. ' .
                       'Avvisare un tecnico per le verifiche del caso.';
            $headers = 'From: ' . $config['alertMailFrom'] . "\r\n" .
                'Reply-To:'. $config['alertMailReplyTo'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);

        }
    } 

   $conn->close();                 
}


$LOG->info('Batch terminato');

return; 


function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

?>