
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
*/

CREATE TABLE PP_DATI_SENSORI
(   
    ID_SENSORE          INT NOT NULL,
    DATAORA_LETTURA     DATETIME NOT NULL DEFAULT  CURRENT_TIMESTAMP,
    TSPID               DECIMAL (8,4),               
    pm                  DECIMAL (8,4),
    age                 INT,
    pm_0                DECIMAL (8,4),
    pm_1                DECIMAL (8,4),
    pm_2                DECIMAL (8,4),
    pm_3                DECIMAL (8,4),
    pm_4                DECIMAL (8,4),
    pm_5                DECIMAL (8,4),
    pm_6                DECIMAL (8,4),
    conf                DECIMAL (8,4),
    pm1                 DECIMAL (8,4),
    pm_10               DECIMAL (8,4),
    p1                  DECIMAL (8,4),
    p2                  DECIMAL (8,4),
    p3                  DECIMAL (8,4),
    p4                  DECIMAL (8,4),
    p5                  DECIMAL (8,4),
    p6                  DECIMAL (8,4),
    Humidity            DECIMAL (8,4),
    Temperature         DECIMAL (8,4),
    Pressure            DECIMAL (8,4),
    Rating              DECIMAL (8,4),
          
   PRIMARY KEY (ID_SENSORE, DATAORA_LETTURA)
);