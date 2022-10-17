$(function(){
    $("#menu1_main").css("display", "none");
    $("#menu2_main").css("display", "none");
    $("#menu3_main").css("display", "none");


    $("#menu1_tag").click(searchFunction);
    $("#menu2_tag").click(newFunction);
    $("#menu3_tag").click(deleteFunction);

    let src_s = $("#button_s").attr("src");
    let src_n = $("#button_n").attr("src");
    let src_d = $("#button_d").attr("src");

    $("#press_insert").click(reloadFunction);
    $("#press_delete").click(reloadFunction);

    function reloadFunction(){
        $(document).ready(function(){
            if(document.URL.indexOf("#")==-1){
            url = document.URL+"#";
            location = "#";
            window.location.href = window.location.href;}
        });
    }


    function searchFunction(){
        $("#menu1_main").slideToggle(500);
        
        if(src_s == "../image/button-minus.png") {
            src_s = "../image/button-plus.png";
            $("#button_s").attr("src",src_s);
        }
        else{
            src_s = "../image/button-minus.png";
            $("#button_s").attr("src",src_s);
        }
    }
    function newFunction(){
        $("#menu2_main").slideToggle(500);
        
        if(src_n == "../image/button-minus.png") {
            src_n = "../image/button-plus.png";
            $("#button_n").attr("src",src_n);
        }
        else{
            src_n = "../image/button-minus.png";
            $("#button_n").attr("src",src_n);
        }
    }
    function deleteFunction(){
        $("#menu3_main").slideToggle(500);
        if(src_d == "../image/button-minus.png") {
            src_d = "../image/button-plus.png";
            $("#button_d").attr("src",src_d);
        }
        else{
            src_d = "../image/button-minus.png";
            $("#button_d").attr("src",src_d);
        }
    }
    
    $("#checkbox").click(function(){
        if($("#checkbox").prop("checked") == true){
            $("#password").attr("type", "text");
        }
        else{
            $("#password").attr("type", "password");
        }
    });

    $("#category").val("math_1");
    categoryChange();

    $("#category").change(categoryChange);

    function categoryChange(){

        const category = $("#category").val();

        const parameter = "category=" + category;

        $.ajax({
            url: "./bbs_category.php",
            data: parameter,
            dataType: "json",
            cache: false,
        })
        .done(function(data){
            $("#subcategory").empty();

            for(let i = 0; i < data.length; i++){
                const name = data[i]["name"];

                let option = $("<option>");
                option.text(name);
                $("#subcategory").append(option);
            }
        });
    }
});