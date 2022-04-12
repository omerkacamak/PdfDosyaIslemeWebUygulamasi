$(function(){

$('input[type=radio][name=customRadioInline1]').change(function(){
	console.log(" " + this.value);
if (this.value == 'sor') {
        $("#secim").removeClass("d-none");
        $("#aramaCubuk").attr('readonly',true);
        $("#sonuclar").html(" ")
    }else{
    	$("#secim").addClass("d-none");
    	$("#aramaCubuk").attr('readonly',false);
    	// $("#sonuclar").removeClass("d-none");
    }
});


$("#floatingSelectGrid1").change(function (){
var ax = $("#floatingSelectGrid1 option:selected").val();
console.log(ax);
}) ;

$("#aramaCubuk").keyup(function(){
 
if($("#aramaCubuk").val().length>=3){

var i = $(this).val();
var s;
if($("#customRadioInline1").prop("checked")){s=1;}
if($("#customRadioInline2").prop("checked")){s=2;}
if($("#customRadioInline3").prop("checked")){s=3;}
if($("#customRadioInline4").prop("checked")){s=4;}
if($("#customRadioInline5").prop("checked")){s=5;}
if($("#customRadioInline6").prop("checked")){
		
}
 
var bilgi = "aranan="+i+"&sec="+s;
$.ajax({
	url: "ara.php",
	type: "post",
	data: bilgi,
	success:function(sonuc){
		console.log("gol");
		//console.log(sonuc);
		$("#sonuclar").html(sonuc);
	},
	error:function(hata){
		$("#sonuclar").html(hata);
	}
});

}
 
 
});


$('#bul').click(function(){
var donem = $('#floatingSelectGrid1 option:selected').val();
var kullanici =$('#floatingSelectGrid2 option:selected').val();
var ders = $('#floatingSelectGrid3 option:selected').val();
var bilgi2 = "donem="+donem+"&kullaniciq="+kullanici+"&ders="+ders;
$('#alinti').html("<b>Sorgu :  </b>" + donem + " " + kullanici + " 'nin " + ders + " dersi için yüklediği projeler");

$.ajax({

	url:"ara2.php",
	type: "post",
	data:bilgi2,
	success:function(snc){
		$("#sonuclar").html(snc);
		console.log(snc);
	},
	error:function(err){
		$("#sonuclar").html(err);
	}

});
});




});