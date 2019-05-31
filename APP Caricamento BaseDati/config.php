<?php
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
    "alertMail" => "inserire mail monitorata. qui arrivera allert se purpleair cambia tracciato json ",
    
    
]; 
?>
