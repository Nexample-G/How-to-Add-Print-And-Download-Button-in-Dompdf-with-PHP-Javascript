<?php 	use Dompdf\Dompdf;
	$database = new mysqli("localhost", "root", "", "mydatabase");
$select = $database->query("SELECT * FROM mydompdf ORDER BY id DESC");
$TR ='<img src="NX.png">
	<h1>NEXAMPLE DOMPDF</h1>
';
	if($select->num_rows > 0){
	while($data = $select->fetch_assoc()){
		$name = $data['name'];
		$email = $data['email'];
		$mobile = $data['mobile'];
$TR .= '<tr>
	<td>'.$name.'</td>
	<td>'.$email.'</td>
	<td>'.$mobile.'</td>
</tr>';
}}
$HTML = '<Table>
<tr>
	<td>name</td>
	<td>email</td>
	<td>mobile</td>
</tr>'.$TR.'</Table>';
if(isset($_GET['PDF'])){
if(empty($_GET['PDF'])){
	$file = '';
	$Attachment = false;
}else{	$file = $_GET['PDF'];
	$Attachment = true;
}	require_once 'dompdf/autoload.inc.php';
	$dompdf = new Dompdf();
	$dompdf->loadHtml($HTML);
	$dompdf->setPaper('A4', 'portrate');
	$dompdf->render();
	$dompdf->stream($file, array("Attachment" => $Attachment));

}else{?>

<script>
window.onload = function(){
	var ifr = document.createElement("iframe");
	ifr.src = "?PDF";
	ifr.id = "PDF";
	ifr.style.width = "0px";
	ifr.style.height = "0px";
	ifr.style.border = "0px";
	document.body.appendChild(ifr);
}
var PDF = function(File){
	var PDFG = document.getElementById("PDF");
if(File){
	PDFG.src = "?PDF="+File;
}else{
	PDFG.contentWindow.print();
}}
</script>
	<input type="submit" value="Download" onclick="PDF('myPDF1');">
	<input type="submit" value="Print PDF" onclick="PDF();">
<?php }?>


