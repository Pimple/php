<?php
/**
 * Denne fil indeholder konstanter som bruges andre steder, så indstillinger let kan ændres på.
 *
 * Brugte "sesamlukop" + "oansdf"#¤"æåø~" (salt) til den kode som står dernede.
 *
 * For at skite kode, så gå til functions.php, og udkommenter tredje linje i funktionen login().
 * Indsæt værdien som PASSWORD i denne fil. SALT skal helst være noget ævl.
 */

define("SECURE", true);
define("HTTPONLY", true);

define("USERNAME", "admin");
define("PASSWORD", "8bbf52da58126d86c24e1afc9f861f799c7de616000e532bfa55452b570d3c7717bd76909e6e94a5f3ae2031f0f5600360888f86445d104725866108e484bef9");
define("SALT", "_I^_8@IfasH1)D7qH03J9kuwQY7b#AZt%@gvw#3U#dk8@O3*AuFWIqwgpLnZC1vN");

// http://www.convertstring.com/Hash/SHA512 (sesamlukop + oansdf"#¤"æåø~)


