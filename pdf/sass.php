<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=gesttoubaaucad', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$ndigueul = "";
$kurel = "";
$reponse = [];
$donneesMembre = [];
$donneesSolde = [];
$donneesSass = [];
$donneesDate = [];
$donnesNum = [];
if (isset($_GET['ndigueul']))
    $ndigueul = $_GET['ndigueul'];

if (isset($_GET['kurel']))
    $kurel = $_GET['kurel'];

$idNomKurel = explode(":", $kurel);

$kurelId = $idNomKurel[0];
$kurelName = $idNomKurel[1];


$idNomNdigueul = explode(":", $ndigueul);

$idNdigueul = $idNomNdigueul[0];
$nomNdigueul = $idNomNdigueul[1];
$totalSass = 0;
$totalSolde = 0;
$index = 0;

if (isset($_GET['ndigueul'])) {

    if ($kurelId != "") {

        $reponse = $bdd->query("SELECT s.id_sass, code , concat(u.prenom,' ',u.nom) as membreInf , s.membre, montant, 
                          DATE_FORMAT(date,'%d/%m/%Y') as date , sum(t.tabi)as tabis, solde FROM Sass s 
                left outer join tabis t on t.id_sass=s.id_sass left outer join Utilisateur u on s.membre= u.id 
                where id_kurel = '$kurelId' and id_ndigueul='$idNdigueul' and s.archive=0 group by s.id_sass asc order by s.membre asc");

    } else {

        $reponse = $bdd->query("SELECT s.id_sass, code , concat(u.prenom,' ',u.nom) as membreInf , 
                s.membre, montant, DATE_FORMAT(date,'%d/%m/%Y') as date , sum(t.tabi)as tabis, solde FROM Sass s 
                left outer join tabis t on t.id_sass=s.id_sass left outer join Utilisateur u on s.membre= u.id 
                where  id_ndigueul='$idNdigueul' and s.archive=0 group by s.id_sass asc order by s.membre asc");
    }


    while ($donnees = $reponse->fetch()) {
        $donnesNum[$index] = $donnees['code'];
        $donneesMembre[$index] = $donnees['membreInf'];
        $donneesSolde[$index] = $donnees['solde'];
        $donneesSass[$index] = $donnees['montant'];
        $donneesDate[$index] = $donnees['date'];
        $totalSass += $donneesSass[$index];
        $totalSolde += $donneesSolde[$index];
        $index++;
    }
}


ob_start();
?>
    <style type="text/css">
        table {
            width: 100%;
            border: none;
            border-collapse: collapse;
        }

        th, td {
            text-align: center
        }

        td {
            text-align: center;
        }

        .dataTable td {
            padding: 10px 5px
        }

        .dataTable th {
            padding: 10px 5px;
        }

    </style>


    <page backtop="15mm" backleft="10mm" backbottom="10mm">
        <page_footer>

            <hr/>
            <p>Signature:</p>
            <p>Date:</p>
        </page_footer>
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 12px">
            <tr>
                <td style="width: 35%; border:none;background:white"></td>
                <td style="width: 30%; border:none;background:white"></td>
                <td style="width: 35%; border:none;background:white"> Le <?php $date = date("d-m-Y");
                    print("$date") ?></td>

            </tr>


        </table>
        <br>
        <br> <br> <br>
        <table>
            <tr>
                <td class="title" style="width: 95%; border:none;background:white"> Situation des
                    sass <?php print("$nomNdigueul") ?></td>
            </tr>
        </table>
        <br> <br>

        <?php
        if ($kurelId != "") {
            ?>
            <table>
                <tr>
                    <td class="title" style="width: 95%; border:none;background:white"><?php print("$kurelName") ?></td>
                </tr>
            </table><br>
            <?php
        }
        ?>
        <table class="dataTable" cellspacing="0"
               style="width: 100%; border: solid 1px black; text-align: center; font-size: 11px;">
            <tr>
                <th style="width: 20%">N° sass</th>
                <th style="width: 20%">Membre</th>
                <th style="width: 20%">Date</th>
                <th style="width: 20%">Montant sass</th>
                <th style="width: 20%">Solde</th>
            </tr>
            <tr>
                <th colspan="5"></th>
            </tr>
        </table>

        <table class="dataTable" cellspacing="0"
               style="width: 100%; border: solid 1px black; text-align: center; font-size: 11px;">
            <?php
            for ($indexImp = 0; $indexImp < $index; $indexImp++) {
                ?>
                <tr>
                    <td style="width: 20%"><?php print(number_format($donnesNum[$indexImp], 0, ',', ' ')) ?></td>
                    <td style="width: 20%">
                        <?php print($donneesMembre[$indexImp]) ?></td>
                    <td style="width: 20%"><?php print($donneesDate[$indexImp]) ?></td>
                    <td style="width: 20%"><?php print(number_format($donneesSass[$indexImp], 0, ',', ' ')) ?></td>
                    <td style="width: 20%"><?php print(number_format($donneesSolde[$indexImp], 0, ',', ' ')) ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td style="width: 20%"><br/><br/><br/><br/></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
            </tr>
            <tr>
                <td colspan="3" style="width: 0%; text-align:center;">Total Sass</td>
                <?php echo '<td style="width: 10%; text-align:center;"><strong> ' . number_format($totalSass, 0, ',', ' ') . '</strong></td> '; ?>
                <?php echo '<td style="width: 10%; text-align:center;"><strong> ' . number_format($totalSolde, 0, ',', ' ') . '</strong></td> '; ?>
            </tr>
        </table>
    </page>
<?php
    $content = ob_get_clean();
    require('html2pdf/html2pdf.class.php');
    try {
        $pdf = new HTML2PDF('P', 'A4', 'fr');
        $pdf->writeHTML($content);
        $pdf->Output('test.pdf');
        $pdf->pdf->SetDisplayMode('fullpage');
    } catch (HTML2PDF_exception $e) {
        die($e);
    }
?>