/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function openTab(tab, index)
{
    for (i = 0; i < document.getElementsByClassName("subTabs").length; i++)
    {
        document.getElementsByClassName("tabs")[i].style.borderBottom = "6px solid #ccc";
        document.getElementsByClassName("tabs")[i].style.color = "#ccc";
        document.getElementsByClassName("subTabs")[i].style.display = "none";
    }
    document.getElementById(tab).style.borderBottom = "6px solid #77f";
    document.getElementById(tab).style.color = "#77f";
    document.getElementById(index+tab).style.display = "block";
}
