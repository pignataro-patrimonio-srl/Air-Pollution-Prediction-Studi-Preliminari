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
* Created: 24 mar 2019
* Last Update: 04/07/2019
*/


return [
    
    //dati per la connessione al database
    "host" => "INSERIRE IP DB HOST",
    "database" => "NOME DEL DATABASE",
    "username" => "UTENTE DEL DATABASE",
    "password" => "PASSWORD ASSOCIATA ALL'UTENTE DEL DATABASE",
    
    //id del sensore (per ora uno solo) da interrogare
    "idSensore1" => "14143",
    
    "sensore-1A" => "URL JSON SENSORE CANALE A",
    "sensore-1A-campi-aggiuntivi" => "URL JSON CAMPI SU THINGSPEAK  fineisce per: ?api_key=**************** al posto degli asterischi va l'api di THINGSPEAK ",
    "sensore-1B" => "URL JSON SENSORE CANALE B",
    "sensore-1B-campi-aggiuntivi" => "URL JSON CAMPI SU THINGSPEAK  fineisce per: ?api_key=**************** al posto degli asterischi va l'api di THINGSPEAK ", 
    
    //tracciato con i dati di entrambi i canali ma per tutti i sensori di purpleair
    "tracciatoJsonSintetico" => "http://www.purpleair.com/data.json",
    //versione tracciato per il quale il programma è scritto
    "versioneTracciato" => "6.0.73",
    //mail a cui spedire il messaggio che il tracciato jason di purpleair è cambiato
    "alertMailTo" => "inserire qui mail monitorata a cui arriva messaggio di risolvere il problema del traccito record",
    //messaggio Mail per alert cambio versione tracciato
    "alertMailSubject" => "Inserire qui oggetto della mail che comunica problema di tracciato",
    //messaggio Mail from che compare nella mail
    "alertMailFrom" => "inserire qui mittente della mail di alarme che viene spedita",
    "alertMailReplyTo" => "inserire qui mail per eventuale replay alla segnalazione: solitamente noreplay@yourdomanin.",

    
    
    
]; 
?>
