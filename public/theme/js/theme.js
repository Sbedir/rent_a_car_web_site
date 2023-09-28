var popslider = "";
var popmaxpage = 0;
var popcurpage = 0;
var habcount = 0;
var habmaxpage = 0;
var habcurpage = 0;
var habslider = "";

$(document).ready(function() {
    $(".parabirimi").mouseover(function(){
        $(".birimacilir").css("display", "");
    }).mouseout(function(){
        $(".birimacilir").css("display", "none");
    });
    
    $(".langselector").mouseover(function(){
        $(".dilacilir").css("display", "");
    }).mouseout(function(){
        $(".dilacilir").css("display", "none");
    });
    
    $(".uyehesap").mouseover(function(){
        $(".girisacilir").css("display", "");
    }).mouseout(function(){
        $(".girisacilir").css("display", "none");
    });
    
    $(".menubaropener>div:eq(0)").click(function(){
        var nexthei = $(".menubar").height();
        if(nexthei==52)
        {
            var tothei = $(".menubar").find("a").length;
            tothei = tothei*52;
            tothei = tothei+52;
            $(".menubar").stop().animate({"height":tothei+"px"}, 500);
        } else {
            $(".menubar").stop().animate({"height":"52px"}, 250);
        }
    });
    
    if(document.getElementById('popslider'))
    {
        popslider = setInterval("popslide()", 5000);
        popsetsize();
        $(window).resize(function(){ popsetsize(); })
        
        $("#popleft").click(function(){
            popslideprev();
        });
        
        $("#popright").click(function(){
            popslidenext();
        });
    }
    
    if(document.getElementById('habrollinner'))
    {
        habcount = $("#habrollinner").find(".haber").length;
        habmaxpage = Math.ceil(habcount/3);
        
        if(habmaxpage>1)
        {
            habslider = setInterval("slidehaber()", 9999);
        }
    }
    
    if(document.getElementById('stickme'))
    {
        var mytop = $("#stickme").offset().top;
        var mywid = $("#stickme").outerWidth();
        
        $(window).scroll(function(){
            var sctop = $(document).scrollTop();
            var myhei = $("#stickme").height();
            if(sctop>=mytop)
            {
                $("#stickme").css({"position":"fixed", "top":"20px", "width":mywid+"px"});
            } else {
                $("#stickme").css({"position":"relative", "top":"0px", "width":"100%"});
            }
        });
    }
});

function slidehaber()
{
    var habnextpage = habcurpage+1;
    if(habnextpage>=habmaxpage) { habnextpage = 0; }
    var habgoesto = habnextpage*465;
    habgoesto = habgoesto+15;
    if(habnextpage==0) { habgoesto = 0; }
    
    $("#habrollinner").animate({marginTop:-habgoesto+"px"}, 1000, function(){
        habcurpage = habnextpage;
    });
}

function popsetsize()
{
    var docsize = $(document).width();
    var needwidth = $(".poparac").width();
    var mustsize = Math.round(needwidth/4);
    mustsize = mustsize-12;
    
    if(docsize<=1000)
    {
        $(".popcol").css({"width":needwidth+"px"});
    } else {
        $(".popcol").css({"width":mustsize+"px"});
    }
    
    //Maxpage hesap...
    var poptotal = $(".popcol").length;
    popmaxpage = poptotal-3;
    if(docsize<=1000) { popmaxpage = poptotal; }
}

function popslide()
{
    var popmustleft = $(".popcol").eq(0).outerWidth();
    var popnextpage = popcurpage+1;
    if(popnextpage>=popmaxpage) { popnextpage = 0; }
    var popgoingto = popnextpage*popmustleft;
    popgoingto = popgoingto+(popnextpage*15);
    
    $("#popslider").animate({marginLeft:-popgoingto+"px"}, 500, function(){
        popcurpage = popnextpage;
    });
}

function popslideprev()
{
    var popmustleft = $(".popcol").eq(0).outerWidth();
    var popnextpage = popcurpage-1;
    if(popnextpage<0) { popnextpage = 0; }
    var popgoingto = popnextpage*popmustleft;
    popgoingto = popgoingto+(popnextpage*15);
    clearInterval(popslider);
    
    $("#popslider").stop().animate({marginLeft:-popgoingto+"px"}, 500, function(){
        popcurpage = popnextpage;
        popslider = setInterval("popslide()", 5000);
    });
}

function popslidenext()
{
    var popmustleft = $(".popcol").eq(0).outerWidth();
    var popnextpage = popcurpage+1;
    if(popnextpage>=popmaxpage) { popnextpage = 0; }
    var popgoingto = popnextpage*popmustleft;
    popgoingto = popgoingto+(popnextpage*15);
    clearInterval(popslider);
    
    $("#popslider").stop().animate({marginLeft:-popgoingto+"px"}, 500, function(){
        popcurpage = popnextpage;
        popslider = setInterval("popslide()", 5000);
    });
}