$(document).ready(function(){var e={chart:{height:350,type:"bar"},plotOptions:{bar:{horizontal:!0,endingShape:"rounded"}},dataLabels:{enabled:!1},series:[{data:[400,430,448,470,540,580,690,1100,1200,1380]}],xaxis:{categories:["South Korea","Canada","United Kingdom","Netherlands","Italy","France","Japan","United States","China","Germany"]}};new ApexCharts(document.querySelector("#basicBar-chart"),e).render();e={chart:{height:350,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0,dataLabels:{position:"top"}}},dataLabels:{enabled:!1,offsetX:-6,style:{fontSize:"12px",colors:["#fff"]}},stroke:{show:!1,width:1,colors:["#fff"],lineCap:"round",curve:"smooth"},series:[{data:[44,55,41,64,22,43,21]},{data:[53,32,33,52,13,44,32]}],xaxis:{categories:[2001,2002,2003,2004,2005,2006,2007]}};new ApexCharts(document.querySelector("#groupedBar"),e).render();e={chart:{height:350,type:"bar",stacked:!0,toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0}},stroke:{width:0,colors:["#fff"]},series:[{name:"Marine Sprite",data:[44,55,41,37,22,43,21]},{name:"Striking Calf",data:[53,32,33,52,13,43,32]},{name:"Tank Picture",data:[12,17,11,9,15,11,20]},{name:"Bucket Slope",data:[9,7,5,8,6,9,4]},{name:"Reborn Kid",data:[25,12,19,32,25,24,10]}],xaxis:{categories:[2008,2009,2010,2011,2012,2013,2014],labels:{formatter:function(e){return e+"K"}}},yaxis:{title:{text:void 0}},tooltip:{y:{formatter:function(e){return e+"K"}}},fill:{opacity:1},legend:{position:"top",horizontalAlign:"left",offsetX:40}};new ApexCharts(document.querySelector("#stackedBar"),e).render();e={chart:{height:350,type:"bar",stacked:!0,toolbar:{show:!1}},colors:["#008FFB","#FF4560"],plotOptions:{bar:{horizontal:!0,barHeight:"80%"}},dataLabels:{enabled:!1},stroke:{width:1,colors:["#fff"]},series:[{name:"Males",data:[.4,.65,.76,.88,1.5,2.1,2.9,3.8,3.9,4.2,4,4.3,4.1,4.2,4.5,3.9,3.5,3]},{name:"Females",data:[-.8,-1.05,-1.06,-1.18,-1.4,-2.2,-2.85,-3.7,-3.96,-4.22,-4.3,-4.4,-4.1,-4,-4.1,-3.4,-3.1,-2.8]}],grid:{xaxis:{showLines:!1}},yaxis:{min:-5,max:5,title:{}},tooltip:{shared:!1,x:{formatter:function(e){return e}},y:{formatter:function(e){return Math.abs(e)+"%"}}},xaxis:{categories:["85+","80-84","75-79","70-74","65-69","60-64","55-59","50-54","45-49","40-44","35-39","30-34","25-29","20-24","15-19","10-14","5-9","0-4"],title:{text:"Percent"},labels:{formatter:function(e){return Math.abs(Math.round(e))+"%"}}}};new ApexCharts(document.querySelector("#negetiveBar"),e).render();e={chart:{height:350,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{barHeight:"100%",distributed:!0,horizontal:!0,dataLabels:{position:"bottom"},endingShape:"rounded"}},colors:["#33b2df","#546E7A","#d4526e","#13d8aa","#A5978B","#2b908f","#f9a3a4","#90ee7e","#f48024","#69d2e7"],dataLabels:{enabled:!0,textAnchor:"start",style:{colors:["#fff"]},formatter:function(e,t){return t.w.globals.labels[t.dataPointIndex]+":  "+e},offsetX:0,dropShadow:{enabled:!0}},series:[{data:[400,430,448,470,540,580,690,1100,1200,1380]}],stroke:{width:1,colors:["#fff"]},xaxis:{categories:["South Korea","Canada","United Kingdom","Netherlands","Italy","France","Japan","United States","China","India"]},yaxis:{labels:{show:!1}},tooltip:{theme:"dark",x:{show:!1},y:{title:{formatter:function(){return""}}}}};new ApexCharts(document.querySelector("#customDatalabelBar"),e).render();e={chart:{height:350,type:"bar",stacked:!0,shadow:{enabled:!0,blur:1,opacity:.5}},plotOptions:{bar:{horizontal:!0,barHeight:"60%"}},dataLabels:{enabled:!1},stroke:{width:2},series:[{name:"Marine Sprite",data:[44,55,41,37,22,43,21]},{name:"Striking Calf",data:[53,32,33,52,13,43,32]},{name:"Tank Picture",data:[12,17,11,9,15,11,20]},{name:"Bucket Slope",data:[9,7,5,8,6,9,4]}],xaxis:{categories:[2008,2009,2010,2011,2012,2013,2014]},yaxis:{title:{text:void 0}},tooltip:{shared:!1,y:{formatter:function(e){return e+"K"}}},fill:{type:"pattern",opacity:1,pattern:{style:["circles","slantedLines","verticalLines","horizontalLines"]}},states:{hover:{filter:"none"}},legend:{position:"top",offsetY:0}};new ApexCharts(document.querySelector("#PatternedBar"),e).render()});