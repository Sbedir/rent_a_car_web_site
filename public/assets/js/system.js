var lang_operror = "";
var lang_afterselect = "";
var lang_loading = "";
var alisdefaulthtml = "";
var donusdefaulthtml = "";

$(document).ready(function() {
    if(document.getElementById('datestart'))
    {
        $(".datepicker").attr("readonly", "readonly");
        $(".datepicker").css({"background":"#ffffff", "z-index":"9999999"});
        
        var laststart = "";
        var curstart = "";
        $("#datestart").datetimepicker({
            dateFormat: 'dd/mm/yy',
            timeFormat: 'HH:mm',
            stepMinute: 15,
            onSelect: function(selected) {
                var mindate = $('#datestart').datepicker('getDate', '+1d');
                mindate.setDate(mindate.getDate()+1); 
                $("#dateend").datepicker("option", "minDate", mindate);
                curstart = $("#datestart").val();
            },
            beforeShow: function () {
                curstart = $("#datestart").val();
                laststart = $("#datestart").val();
            },
            onClose : function() {
                if(document.getElementById('spectarihselector'))
                {
                    if(curstart!=laststart)
                    {
                        var d1 = new Date($('#datestart').datepicker('getDate'));
                        var d2 = new Date($('#dateend').datepicker('getDate'));
                        var diff = (Math.abs((d2-d1)/86400000));
                        
                        if(diff>=rezmin)
                        {
                            $("#rzfrm").submit();
                        } else {
                            var nextdate = $('#datestart').datepicker('getDate', '+1d');
                            nextdate.setDate(nextdate.getDate()+rezmin);
                            $("#dateend").datepicker("option","minDate", nextdate);
                            $("#rzfrm").submit();
                        }
                    }
                }
            }
        });
        
        var lastend = "";
        var curend = "";
        $("#dateend").datetimepicker({
            dateFormat: 'dd/mm/yy',
            timeFormat: 'HH:mm',
            stepMinute: 15,
            onSelect: function(selected) {
                var maxdate = $('#dateend').datepicker('getDate', '-1d');
                maxdate.setDate(maxdate.getDate()-1); 
                $("#datestart").datepicker("option", "maxDate", maxdate);
                curend = $("#dateend").val();
            },
            beforeShow: function () {
                curend = $("#dateend").val();
                lastend = $("#dateend").val();
            },
            onClose : function() {
                if(document.getElementById('spectarihselector'))
                {
                    if(curend!=lastend)
                    {
                        var d1 = new Date($('#datestart').datepicker('getDate'));
                        var d2 = new Date($('#dateend').datepicker('getDate'));
                        var diff = (Math.abs((d2-d1)/86400000));
                        
                        if(diff>=rezmin)
                        {
                            $("#rzfrm").submit();
                        } else {
                            $("#dateend").val(lastend);
                            alert(rezmintx);
                        }
                    }
                }
            }
        });
    }
    
    $(".datepickyears").attr("readonly", "readonly");
    $(".datepickyears").css("background", "#ffffff");
    $(".datepickyears").datepicker({dateFormat: 'dd/mm/yy', changeYear: true, changeMonth: true, yearRange: '1920:2010'});
    
    $(".aracfilter_marka").keyup(function(){
        var thisval = $(this).val().toLowerCase();
        $(".araclisting").each(function(){
            var thisrc = $(this).attr("data-marka").toLowerCase();
            if(thisrc.indexOf(thisval)<=-1&&thisval!="")
            {
                $(this).attr("marka-passed", "0");
            } else {
                $(this).attr("marka-passed", "1");
            }
        });
        
        filter_show();
    });
    
    $(".aracfilter_yakit").change(function(){
        var thisval = $(this).val();
        $(".araclisting").each(function(){
            var thisrc = $(this).attr("data-yakit");
            if(thisrc!=thisval&&thisval!="")
            {
                $(this).attr("yakit-passed", "0");
            } else {
                $(this).attr("yakit-passed", "1");
            }
        });
        
        filter_show();
    });
    
    $(".aracfilter_vites").change(function(){
        var thisval = $(this).val();
        $(".araclisting").each(function(){
            var thisrc = $(this).attr("data-vites");
            if(thisrc!=thisval&&thisval!="")
            {
                $(this).attr("vites-passed", "0");
            } else {
                $(this).attr("vites-passed", "1");
            }
        });
        
        filter_show();
    });
    
    $(".aracfilter_kasa").change(function(){
        var thisval = $(this).val();
        $(".araclisting").each(function(){
            var thisrc = $(this).attr("data-kasa");
            if(thisrc!=thisval&&thisval!="")
            {
                $(this).attr("kasa-passed", "0");
            } else {
                $(this).attr("kasa-passed", "1");
            }
        });
        
        filter_show();
    });
    
    $(".aracfilter_kat").change(function(){
        var thisval = $(this).val();
        $(".araclisting").each(function(){
            var thisrc = $(this).attr("data-kat");
            if(thisrc!=thisval&&thisval!="")
            {
                $(this).attr("kat-passed", "0");
            } else {
                $(this).attr("kat-passed", "1");
            }
        });
        
        filter_show();
    });
    
    $(".aracfilter_musait").click(function(){
        var thischk = $(this).prop("checked");
        $(".araclisting").each(function(){
            var thisrc = $(this).attr("data-dsb");
            if(thischk==true)
            {
                if(thisrc==1) { $(this).attr("dsb-passed", "0"); } else { $(this).attr("dsb-passed", "1"); }
            } else {
                $(this).attr("dsb-passed", "1");
            }
        });
        
        filter_show();
    });
    
    // $(".extra").find(".extcheck").find("input[type=checkbox]").change(function() {
    //     var thisobj = $(this).parent();
    //     setTimeout(function(){
    //         var toplamgun = $("#gunsayisi").html();
    //         var thistype = $(thisobj).attr("data-type");
    //         var thisfiyat = $(thisobj).attr("data-fiyat");
    //         if(thistype==1) { thisfiyat = parseFloat(thisfiyat)*toplamgun; }
    //         if(thistype==3) { thisfiyat = 0; }
    //         var totalready = $(".total").find("label").find("span").eq(0).html();
    //         totalready = totalready.replace(",", "");
            
    //         var thischked = $(thisobj).find("input[type=checkbox]").eq(0).prop("checked");
    //         if(thischked)
    //         {
    //             var newfiyat = parseFloat(totalready)+parseFloat(thisfiyat);
    //         } else {
    //             var newfiyat = parseFloat(totalready)-parseFloat(thisfiyat);
    //         }
            
    //         $(".total").find("label").find("span").eq(0).html(newfiyat);
    //         var strfiyat = $(".total").find("label").find("span").eq(0).html();
    //         if(strfiyat.indexOf(".")<=-1) { strfiyat = strfiyat+".00"; }
    //         var strexp = strfiyat.split(".");
    //         var totfy = strexp[0];
    //         var kusurat = strexp[1];
    //         if(kusurat.length==1) { kusurat = kusurat+"0"; }
    //         if(kusurat.length>2) { kusurat = kusurat.substr(0, 2); }
    //         strfiyat = totfy+"."+kusurat;
            
    //         $(".total").find("label").find("span").eq(0).html(strfiyat);
    //     }, 250);
    // });
    
    //$(".phone").mask("(999) 999 99 99");
    
    // setalisdefaulthtml();
    // setdonusdefaulthtml();
    
  
    $("#setalistext").click(function(){
        $("#open1").css("display", "");
        fetch('genel/il', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            $('#open1').html('');
            $('#open1').append('<a href="javascript:void(0);" onclick="showkonum(0)"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
            data.forEach(x=>{
                $('#open1').append('<a href="javascript:void(0);" onclick="showkonum('+x.il_id+')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.il_name+'</a>');
           })
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    
    $("#setdonustext").click(function(){
        $("#open2").css("display", "");
        fetch('genel/il', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            $('#open2').html('');
            $('#open2').append('<a href="javascript:void(0);" onclick="showkonum2(0)"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
            data.forEach(x=>{
                $('#open2').append('<a href="javascript:void(0);" onclick="showkonum2('+x.il_id+')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.il_name+'</a>');
           })
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    
    $(".menua.fylist,.foota.fylist").click(function(event){
        event.preventDefault();
        $.post("/emc_ajax.php", {"do":"resetrezformsubmit"}, function(data){ document.location.href = '/fiyat-listesi'; });
    });
    
    $(".shortcut_container").fadeIn("slow");
    $(".shortcut_icon").mouseover(function(){
        var thistt = $(this).attr("data-tooltip");
        var exists = $(this).find("em").length;
        if(exists<=0) { $(this).find("img").after("<em>"+thistt+"</em>"); }
    }).mouseout(function(){
        $(this).find("em").remove();
    });
});

function filter_show()
{
    $(".araclisting").each(function(){
        var passed_marka = $(this).attr("marka-passed");
        if(passed_marka!=0) { passed_marka = 1; }
        var passed_yakit = $(this).attr("yakit-passed");
        if(passed_yakit!=0) { passed_yakit = 1; }
        var passed_vites = $(this).attr("vites-passed");
        if(passed_vites!=0) { passed_vites = 1; }
        var passed_kasa = $(this).attr("kasa-passed");
        if(passed_kasa!=0) { passed_kasa = 1; }
        var passed_kat = $(this).attr("kat-passed");
        if(passed_kat!=0) { passed_kat = 1; }
        var passed_musait = $(this).attr("dsb-passed");
        if(passed_musait!=0) { passed_musait = 1; }
        
        if(passed_marka==1&&passed_yakit==1&&passed_vites==1&&passed_kasa==1&&passed_kat==1&&passed_musait==1)
        {
            $(this).stop().fadeIn("fast");
        } else {
            $(this).stop().fadeOut("fast");
        }
    });
}

// function rezformsb(o, e)
// {
//     e.preventDefault();
    
//     var alisloc = $("input[name=alisloc]").val();
//     var donusloc = $("input[name=donusloc]").val();
//     var alistarih = $("input[name=alistarih]").val();
//     var donustarih = $("input[name=donustarih]").val();
    
//     if(alisloc>0&&donusloc>0&&alistarih!=""&&donustarih!="")
//     {
//         showloader();
//         $(".rezbig").val(lang_loading);
//         $(".rezbig").attr("disabled", "disabled");
        
//         setTimeout(function(){
//             $.post("/emc_ajax.php", {"do":"setrezsettings", "alisloc":alisloc, "donusloc":donusloc, "alistarih":alistarih, "donustarih":donustarih}, function(data){
//                 if(data=="ok")
//                 {
//                     document.location.href = $(o).attr("action");
//                 } else {
//                     alert(lang_operror);
//                 }
//             });
//         }, 2500);
//     } else {
//         document.location.href = '/fiyat-listesi';
//     }
// }

// function showkonum(locid)
// {
//     $("#open1").html(lang_loading);
//     setTimeout(function(){
//         $.post("/emc_ajax.php", {"do":"showkonum", "locid":locid}, function(data){
//             $("#open1").html(data);
//         });
//     }, 500);
// }

// function setalisdefaulthtml()
// {
//     alisdefaulthtml = $("#open1").html();
// }

// function setdonusdefaulthtml()
// {
//     donusdefaulthtml = $("#open2").html();
// }

// function showkonumreset()
// {
//     $("#open1").html(alisdefaulthtml);
//     $("#open2").html(donusdefaulthtml);
// }

// function selectkonum(id, txt)
// {
//     $("#open1").css("display", "none");
//     showkonumreset();
    
//     $("#setalisloc").val(id);
//     $("#setalistext").val(txt);
    
//     $("#setdonusloc").val(id);
//     $("#setdonustext").val(txt);
    
//     if(document.getElementById('spectarihselector'))
//     {
//         $("#rzfrm").submit();
//     }
// }

function showkonumdonus(locid)
{
    $("#open2").html(lang_loading);
    setTimeout(function(){
        $.post("/emc_ajax.php", {"do":"showkonum2", "locid":locid}, function(data){
            $("#open2").html(data);
        });
    }, 500);
}

function selectkonumdonus(id, txt)
{
    $("#open2").css("display", "none");
    showkonumreset();
    
    $("#setdonusloc").val(id);
    $("#setdonustext").val(txt);
    
    if(document.getElementById('spectarihselector'))
    {
        $("#rzfrm").submit();
    }
}

function setuyebox(o)
{
    var stt = $(o).prop("checked");
    if(stt==true)
    {
        $(".uyebox").css("height", "auto");
        $(".uyebox").find("input[type=password]").eq(0).focus();
        $("#pass1,#pass2").attr("required", "required");
    } else {
        $(".uyebox").css("height", "75px");
        $("#pass1,#pass2").removeAttr("required");
        $("#pass1,#pass2").val("");
    }
}

function setparabirimi(id)
{
    showloader();
    
    setTimeout(function(){
        $.post("/emc_ajax.php", {"do":"setparabirimi","id":id}, function(data){
            if(data=="ok")
            {
                document.location.href = document.location.href;
            } else {
                alert(lang_operror);
            }
        });
    }, 2500);
}

function setdil(id)
{
    showloader();
    
    setTimeout(function(){
        $.post("/emc_ajax.php", {"do":"setdil","id":id}, function(data){
            if(data=="ok")
            {
                document.location.href = document.location.href;
            } else {
                alert(lang_operror);
            }
        });
    }, 2500);
}

function reserve(o, e)
{
    e.preventDefault();
    showloader();
    
    setTimeout(function(){
        $.post("/emc_ajax.php", $(o).serialize(), function(data){
            if(data.indexOf("<ok>")!=-1)
            {
                data = data.replace("<ok>", "");
                var newhtml = '<form action="/sorgulama" method="post" target="_self" id="newrezform" enctype="application/x-www-form-urlencoded">';
                newhtml += '<input type="hidden" name="kod" value="'+data+'" />';
                newhtml += '<input type="hidden" name="newrez" value="1" />';
                newhtml += '</form>';
                
                $("body").append(newhtml);
                $("#newrezform").submit();
            } else {
                if(data==""||data=="err")
                {
                    alert(lang_operror);
                } else {
                    alert(data);
                    hideloader();
                }
            }
        });
    }, 2500);
}

function showloader()
{
    $("#loader").remove();
    var newhtml = '<div id="loader" style="display:none;"><div id="loaderin"><div id="loadercell"><div id="loadermodal"><img src="/images/loader.gif" /><br />'+lang_loading+'</div></div></div></div>';
    $("body").append(newhtml);
    $("#loader").fadeIn("fast");
}

function hideloader()
{
    $("#loader").remove();
}