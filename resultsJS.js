var cornflowerBlue = '#6495ED';
var deepBlue = '#23527C';
var medBlue = '#337ab7';
function writeTable()
{
    var l = document.getElementById("sell");
    var s = "";
    var bg = cornflowerBlue;
    if(vendorTitleSell.length > 10)
    {
        for(var i = 0; i < 10; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkSell[i] + "' target='_blank'>" + vendorTitleSell[i] + "</a></td><td><a href='" + linkSell[i] + "' target='_blank'>$" + priceSell[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
        s += "<tr style='background: #444444;'><td colspan='2'><a href='javascript:expandTable(1);'>v Show All Results v</a></td></tr>";
    }
    else
    {
        for(var i = 0; i < vendorTitleSell.length; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkSell[i] + "' target='_blank'>" + vendorTitleSell[i] + "</a></td><td><a href='" + linkSell[i] + "' target='_blank'>$" + priceSell[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
    }
    l.innerHTML += s;
    
    l = document.getElementById("buy");
    s = "";
    bg = cornflowerBlue;
    if(vendorTitleBuy.length > 10)
    {
        for(var i = 0; i < 10; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkBuy[i] + "' target='_blank'>" + vendorTitleBuy[i] + "</a></td><td><a href='" + linkBuy[i] + "' target='_blank'>$" + priceBuy[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
        s += "<tr style='background: #444444;'><td colspan='2'><a href='javascript:expandTable(2);'>v Show All Results v</a></td></tr>";
    }
    else
    {
        for(var i = 0; i < vendorTitleBuy.length; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkBuy[i] + "' target='_blank'>" + vendorTitleBuy[i] + "</a></td><td><a href='" + linkBuy[i] + "' target='_blank'>$" + priceBuy[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
    }
    l.innerHTML += s;
}
function expandTable(p)
{
    var l;
    if(p == 1)
    {
        l = document.getElementById("sell");
        var s = l.innerHTML;
        s = s.substring(0,s.lastIndexOf("<tr"));
        var bg = cornflowerBlue;
        for(var i = 10; i < vendorTitleSell.length; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkSell[i] + "' target='_blank'>" + vendorTitleSell[i] + "</a></td><td><a href='" + linkSell[i] + "' target='_blank'>$" + priceSell[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
        s += "<tr style='background: #444444;'><td colspan='2'><a href='javascript:contractTable(1);'>^ Show Less Results ^</a></td></tr>";
        l.innerHTML = s;
    }
    if(p == 2)
    {
        l = document.getElementById("buy");
        var s = l.innerHTML;
        s = s.substring(0,s.lastIndexOf("<tr"));
        var bg = cornflowerBlue;
        for(var i = 10; i < vendorTitleBuy.length; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkBuy[i] + "' target='_blank'>" + vendorTitleBuy[i] + "</a></td><td><a href='" + linkBuy[i] + "' target='_blank'>$" + priceBuy[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
        s += "<tr style='background: #444444;'><td colspan='2'><a href='javascript:contractTable(2);'>^ Show Less Results ^</a></td></tr>";
        l.innerHTML = s;
    }
}
function contractTable(p)
{
    var l;
    if(p == 1)
    {
        l = document.getElementById("sell");
        var s = l.innerHTML;
        s = s.substring(0,s.indexOf("<!--Here") + "<!--Here go results--\>".length);
        var bg = cornflowerBlue;
        for(var i = 0; i < 10; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkSell[i] + "' target='_blank'>" + vendorTitleSell[i] + "</a></td><td><a href='" + linkSell[i] + "' target='_blank'>$" + priceSell[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
        s += "<tr style='background: #444444;'><td colspan='2'><a href='javascript:expandTable(1);'>v Show All Results v</a></td></tr>";
        l.innerHTML = s;
    }
    if(p == 2)
    {
        l = document.getElementById("buy");
        var s = l.innerHTML;
        s = s.substring(0,s.indexOf("<!--Here") + "<!--Here go results--\>".length);
        var bg = cornflowerBlue;
        for(var i = 0; i < 10; i++)
        {
            s += "<tr class='listItem' style='background:" + bg + ";'><td style='border-right:1px solid white;'><a href='" + linkBuy[i] + "' target='_blank'>" + vendorTitleBuy[i] + "</a></td><td><a href='" + linkBuy[i] + "' target='_blank'>$" + priceBuy[i] + "</a></td></tr>";
            if(bg == cornflowerBlue) bg = medBlue;
            else bg=cornflowerBlue;
        }
        s += "<tr style='background: #444444;'><td colspan='2'><a href='javascript:expandTable(2);'>v Show All Results v</a></td></tr>";
        l.innerHTML = s;
    }
}
function showGraphs()
{
    var l = document.getElementById("graphSlide");
    if(document.getElementById("showGraphs").innerHTML == "See Book History")
    {
        l.style.webkitClipPath = "inset(0% 0% 0% 0%)";
        l.style.height = "50vh";
        document.getElementById("showGraphs").innerHTML = "Hide Book History";
    }
    else
    {
        l.style.webkitClipPath = "inset(0% 0% 100% 0%)";
        l.style.height = "0vh";
        document.getElementById("showGraphs").innerHTML = "See Book History";
    }
}