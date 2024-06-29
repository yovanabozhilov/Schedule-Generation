<?php
namespace controller;

require_once __DIR__ . '/../model/DAO/PresentationDAO.php'; 
require_once __DIR__ . '/../model/Presentation.php';
require_once __DIR__ . '/../model/DAO/AdminDAO.php'; 

use model\DAO\PresentationDAO;
use model\Presentation;
use model\DAO\AdminDAO;

class PresentationController {
    
    private static $instance;

    private function __construct(){
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new PresentationController();
        }
        return self::$instance;
    }

    public static function saveInterests() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Interests']) && !empty($_POST['Interests'])) {
            try {
                $presentationDAO = new \model\DAO\PresentationDAO();
                $presentations = $presentationDAO->getAllPresentations();

                if ($presentations === false) {
                    header('HTTP/1.1 500 Server Error');
                    die("Error fetching presentations");
                }

                foreach ($presentations as $presentation) {
                    if (isset($_POST['Interests'][$presentation->getId()])) {
                        $interest = htmlentities($_POST['Interests'][$presentation->getId()]);
                        $presentation->setInterest($interest);
                        $presentationDAO->updatePresentationInterest($presentation->getId(), $interest);

                        
                        error_log("Updating presentation ID: " . $presentation->getId() . " with interest: " . $interest);
                    }
                }

                header('Location: index.php?page=main'); // Change to your desired success page
                exit();
            } catch (\PDOException $e) {
                header('HTTP/1.1 500 Server Error');
                die($e->getMessage());
            } catch (\Exception $e) {
                header('HTTP/1.1 500 Server Error');
                die($e->getMessage());
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            die("Invalid request: Missing or empty interests data");
        }
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
        die("Invalid request method");
    }
}

    public function generateHTMLTable() {
    try {
        $presentationDAO = new \model\DAO\PresentationDAO();
        $presentations = $presentationDAO->getAllPresentations();

        $html = '';

        if (!empty($presentations)) {
            ob_start();
            ?>
            <style>
                .interest-option-green { background-color: #B2E792; color: black; }
                .interest-option-blue { background-color: #ADC7C6; color: black; }
                .interest-option-purple { background-color: #C9A7C8; color: black; }
                .interest-select { width: 150px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid black; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .row-green { background-color: lightgreen; }
                .row-blue { background-color: lightblue; }
                .row-purple { background-color: plum; }
                .row-default { background-color: white; }
            </style>
            <script>
                function updateRowColor(selectElement) {
                    var row = selectElement.parentNode.parentNode;
                    var selectedValue = selectElement.value;

                    row.classList.remove('row-green', 'row-blue', 'row-purple', 'row-default'); 

                    if (selectedValue == 'Мисля да отида') {
                        row.classList.add('row-green');
                    } else if (selectedValue == 'Интересно ми е') {
                        row.classList.add('row-blue');
                    } else if (selectedValue == 'Може да е интересно') {
                        row.classList.add('row-purple');
                    } else {
                        row.classList.add('row-default'); 
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                    var selects = document.querySelectorAll('.interest-select');
                    selects.forEach(function(select) {
                        var row = select.parentNode.parentNode;
                        updateRowColor(select); // Update row color based on initial selection
                    });
                });
            </script>
            <?php
            $html .= ob_get_clean();

            $html .= '<form method="post" action="./handle_requests.php?target=presentation&action=saveInterests">';
            $html .= '<table>';
            $html .= '<tr>';
            $html .= '<th>Ид</th>';
            $html .= '<th>Заглавие</th>';
            $html .= '<th>Дата</th>';
            $html .= '<th>Автор</th>';
            $html .= '<th>Фн</th>';
            $html .= '<th>Час</th>';
            $html .= '<th>Стая</th>';
            $html .= '<th>Проявен интерес</th>';
            $html .= '</tr>';

            foreach ($presentations as $presentation) {
                $interest = htmlentities($presentation->getInterest());
                $rowClass = 'row-default'; 

                if ($interest == 'Мисля да отида') {
                    $rowClass = 'row-green';
                } elseif ($interest == 'Интересно ми е') {
                    $rowClass = 'row-blue';
                } elseif ($interest == 'Може да е интересно') {
                    $rowClass = 'row-purple';
                }

                $html .= '<tr class="' . $rowClass . '">';
                $html .= '<td>' . $presentation->getId() . '</td>';
                $html .= '<td>' . $presentation->getTitle() . '</td>';
                $html .= '<td>' . $presentation->getDate() . '</td>';
                $html .= '<td>' . $presentation->getAuthor() . '</td>';
                $html .= '<td>' . $presentation->getFn() . '</td>';
                $html .= '<td>' . $presentation->getHour() . '</td>';
                $html .= '<td>' . $presentation->getRoom() . '</td>';
                $html .= '<td>';
                $html .= '<select id="interest_' . $presentation->getId() . '" name="Interests[' . $presentation->getId() . ']" class="interest-select" onchange="updateRowColor(this)">';
                $html .= '<option value=""' . ($interest == '' ? ' selected' : '') . '>Изберете интерес</option>';
                $html .= '<option value="Мисля да отида" ' . ($interest == 'Мисля да отида' ? 'selected' : '') . ' class="interest-option-green">Мисля да отида</option>';
                $html .= '<option value="Интересно ми е" ' . ($interest == 'Интересно ми е' ? 'selected' : '') . ' class="interest-option-blue">Интересно ми е</option>';
                $html .= '<option value="Може да е интересно" ' . ($interest == 'Може да е интересно' ? 'selected' : '') . ' class="interest-option-purple">Може да е интересно</option>';
                $html .= '</select>';
                $html .= '</td>';
                $html .= '</tr>';
            }

            $html .= '</table>';
            $html .= '<input type="submit" value="Запази интересите">';
            $html .= '</form>';
        } else {
            $html = "No presentations found.";
        }

        return $html;
    } catch (\PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
	
	
	public function exportToExcel($htmlTable, $filename = 'presentations.xls') {
        header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $filename);

		var_dump($htmlTable);

        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
                 xmlns:x="urn:schemas-microsoft-com:office:excel"
                 xmlns="http://www.w3.org/TR/REC-html40">';
        echo '<head>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        echo '<!--[if gte mso 9]><xml>';
        echo '<x:ExcelWorkbook>';
        echo '<x:ExcelWorksheets>';
        echo '<x:ExcelWorksheet>';
        echo '<x:Name>Sheet1</x:Name>';
        echo '<x:WorksheetOptions>';
        echo '<x:DisplayGridlines/>';
        echo '</x:WorksheetOptions>';
        echo '</x:ExcelWorksheet>';
        echo '</x:ExcelWorksheets>';
        echo '</x:ExcelWorkbook>';
        echo '</xml><![endif]-->';
        echo '</head>';
        echo '<body>';
        echo $htmlTable; 
        echo '</body>';
        echo '</html>';
		
		exit; 
    }
	
   public function exportToPdf($htmlContent, $pdfFilename = 'presentations.pdf') {
        $htmlFile = tempnam(sys_get_temp_dir(), 'html') . '.html';
        file_put_contents($htmlFile, $htmlContent);

        $pdfFile = tempnam(sys_get_temp_dir(), 'pdf') . '.pdf';

        $htmlFileUrl = 'file:///' . str_replace('\\', '/', $htmlFile);

        $cmd = '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf" --page-size A4 --load-error-handling ignore --encoding UTF-8 ' . escapeshellarg($htmlFileUrl) . ' ' . escapeshellarg($pdfFile) . ' 2>&1';

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            die('Error generating PDF: ' . implode("\n", $output));
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFilename . '"');

        readfile($pdfFile);

        unlink($htmlFile);
        unlink($pdfFile);

        exit;
    }
	
public function exportToZip($htmlContent, $filename = 'presentations.zip') {
    $htmlFile = tempnam(sys_get_temp_dir(), 'html') . '.html';
    file_put_contents($htmlFile, $htmlContent);
    
    if (!$htmlFile || !file_exists($htmlFile)) {
        die('Failed to create temporary HTML file.');
    }
    
    $zipFile = tempnam(sys_get_temp_dir(), 'zip') . '.zip';
    
    $htmlFileUnix = str_replace('\\', '/', $htmlFile);
    
    $dirName = escapeshellarg(dirname($htmlFileUnix));
    $baseName = escapeshellarg(basename($htmlFileUnix));
    
    $cmd = '"C:\\Windows\\System32\\tar" -a -cf ' . escapeshellarg($zipFile) . ' -C ' . $dirName . ' ' . $baseName;
    
    error_log('Tar Command: ' . $cmd);
    
    exec($cmd . ' 2>&1', $output, $returnCode);
    
    if ($returnCode !== 0) {
        die('Failed to create ZIP archive: ' . implode("\n", $output));
    }
    
    header('Content-Type: application/zip'); 
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($zipFile));
    
    readfile($zipFile);
    
    unlink($htmlFile);
    unlink($zipFile);
    
    exit;
}












}

