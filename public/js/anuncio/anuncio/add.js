var map;

$( document ).ready(function() {
    
    
    
    $("#msg_erro_geral").hide();
    $("#msg_sucesso").hide();
    
    $("#incluir").click(function(){
        
        remove_msg_erro();
        incluir();
        
    });
    
});

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
    });
}

function incluir(){
    
    var data = {};
    
    $("input").each(function(){
        
        data[$(this).attr('name')] = $(this).val();
        
    });
    
    $("select").each(function(){
        
        data[$(this).attr('name')] = $(this).val();
        
    });
    
    console.log(data);
    
        var request = $.ajax({
        
        url: "/anuncio/add",
        method: "POST",
        data: data,
        dataType: "json",
        success: function(data){
            
            console.log(data);
            
            if(data.cdMsg == 0){
            
                add_msg_erro(data.msg);
                
            }else if(data.cdMsg == 1){
                
                msg_sucesso("Anúncio incluido com sucesso! Adicione uma imagem!");
                
                $(".form-group").hide();
                $("#add_imagem").show();
                
            }
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      console.log(jqXHR.responseText);
    });
    
}

function envia_img(campo){
    
    if($("#"+campo).find('img').attr("src") == undefined){
        alert("Informe a imagem!");
        return false;
    }
    
    if($("input[name='cdBarra']").val() == ""){
        alert("Inclua o anuncio!");
        return false;
    }
    
    var data = {};
        
    data['cdBarra'] = $("input[name='cdBarra']").val();
    data['imgMat'] = $("#"+campo).find('img').attr("src");
    
    console.log(data);
    
        var request = $.ajax({
        
        url: "/anuncio/addImagem",
        method: "POST",
        data: data,
        dataType: "json",
        success: function(data){
            
            console.log(data);
            
            if(data.cdMsg == 0)
                msg_erro_geral(data.msg);
            else if(data.cdMsg == 1)
                msg_sucesso("Imagem incluida com sucesso!")
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      console.log(jqXHR.responseText);
    });
    
}

function add_msg_erro(data){
    
    var menssagem;
            
    $.each(data, function(campo, tpErro){
        
        menssagem = "<ul class='msg_erro'>"
        
        $.each(tpErro, function(tipo, msg){
            
            menssagem += "<li>"+msg+"</li>"
            
        });
        
        menssagem += "</ul>"
        
        if($("input[name='"+campo+"']").length)
            $("input[name='"+campo+"']").after(menssagem);
            
        if($("select[name='"+campo+"']").length)
            $("select[name='"+campo+"']").after(menssagem);
        
    });
    
}

function remove_msg_erro(){
    
    $(".msg_erro").remove();
    
}

function msg_erro_geral(msg){
    
    $("#msg_erro_geral").html(msg);
    $("#msg_erro_geral").show();
    
    
}

function apaga_msg(){
    
    $("#msg_erro_geral").hide();
    $("#msg_sucesso").hide();
    
}

function msg_sucesso(msg){
    
    $("#msg_sucesso").html(msg);
    $("#msg_sucesso").show();
}