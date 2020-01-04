function roundUp(num, precision) {
  precision = Math.pow(10, precision)
  return Math.ceil(num * precision) / precision
}

$.get("model/data_visualisasi_json.php", function(data, status){
  
  var jmlEnergiPositif = 0;
  var jmlEnergiNegatif = 0;
  var jmlInfrastrukturPositif = 0;
  var jmlInfrastrukturNegatif = 0;
  var jmlMasyarakatPositif = 0;
  var jmlMasyarakatNegatif = 0;
  var jmlKesehatanPositif = 0;
  var jmlKesehatanNegatif = 0;
  var jmlTransportasiPositif = 0;
  var jmlTransportasiNegatif = 0;
  var jmlPemerintahPositif = 0;
  var jmlPemerintahNegatif = 0;
  var jmlPendidikanPositif = 0;
  var jmlPendidikanNegatif = 0;
  var jmlTeknologiPositif = 0;
  var jmlTeknologiNegatif = 0;

  for (var i = 0; i < data.tanggal.length; i++) {
    
    jmlEnergiPositif += data.data.Energi.sentimenPositif[i];
    jmlEnergiNegatif += data.data.Energi.sentimenNegatif[i];
    jmlInfrastrukturPositif += data.data.Infrastruktur.sentimenPositif[i];
    jmlInfrastrukturNegatif += data.data.Infrastruktur.sentimenNegatif[i];
    jmlMasyarakatPositif += data.data.Masyarakat.sentimenPositif[i];
    jmlMasyarakatNegatif += data.data.Masyarakat.sentimenNegatif[i];
    jmlKesehatanPositif += data.data.Kesehatan.sentimenPositif[i];
    jmlKesehatanNegatif += data.data.Kesehatan.sentimenNegatif[i];
    jmlTransportasiPositif += data.data.Transportasi.sentimenPositif[i];
    jmlTransportasiNegatif += data.data.Transportasi.sentimenNegatif[i];
    jmlPemerintahPositif += data.data.Pemerintah.sentimenPositif[i];
    jmlPemerintahNegatif += data.data.Pemerintah.sentimenNegatif[i];
    jmlPendidikanPositif += data.data.Pendidikan.sentimenPositif[i];
    jmlPendidikanNegatif += data.data.Pendidikan.sentimenNegatif[i];
    jmlTeknologiPositif += data.data.Teknologi.sentimenPositif[i];
    jmlTeknologiNegatif += data.data.Teknologi.sentimenNegatif[i];
  };

  var jmlSemuaSentimen = jmlEnergiPositif+jmlEnergiNegatif+jmlInfrastrukturPositif+jmlInfrastrukturNegatif+jmlMasyarakatPositif+jmlMasyarakatNegatif+jmlKesehatanPositif+jmlKesehatanNegatif+jmlTransportasiPositif+jmlTransportasiNegatif+jmlPemerintahPositif+jmlPemerintahNegatif+jmlPendidikanPositif+jmlPendidikanNegatif+jmlTeknologiPositif+jmlTeknologiNegatif;

  var persenEnergiPositif = (jmlEnergiPositif/jmlSemuaSentimen)*100;
  var persenEnergiNegatif = (jmlEnergiNegatif/jmlSemuaSentimen)*100;
  var persenInfrastrukturPositif = (jmlInfrastrukturPositif/jmlSemuaSentimen)*100;
  var persenInfrastrukturNegatif = (jmlInfrastrukturNegatif/jmlSemuaSentimen)*100;
  var persenMasyarakatPositif = (jmlMasyarakatPositif/jmlSemuaSentimen)*100;
  var persenMasyarakatNegatif = (jmlMasyarakatNegatif/jmlSemuaSentimen)*100;
  var persenKesehatanPositif = (jmlKesehatanPositif/jmlSemuaSentimen)*100;
  var persenKesehatanNegatif = (jmlKesehatanNegatif/jmlSemuaSentimen)*100;
  var persenTransportasiPositif = (jmlTransportasiPositif/jmlSemuaSentimen)*100;
  var persenTransportasiNegatif = (jmlTransportasiNegatif/jmlSemuaSentimen)*100;
  var persenPemerintahPositif = (jmlPemerintahPositif/jmlSemuaSentimen)*100;
  var persenPemerintahNegatif = (jmlPemerintahNegatif/jmlSemuaSentimen)*100;
  var persenPendidikanPositif = (jmlPendidikanPositif/jmlSemuaSentimen)*100;
  var persenPendidikanNegatif = (jmlPendidikanNegatif/jmlSemuaSentimen)*100;
  var persenTeknologiPositif = (jmlTeknologiPositif/jmlSemuaSentimen)*100;
  var persenTeknologiNegatif = (jmlTeknologiNegatif/jmlSemuaSentimen)*100;


  var otomasiEnergi = roundUp((persenEnergiPositif - persenEnergiNegatif),1);
  var otomasiInfrastruktur = roundUp((persenInfrastrukturPositif - persenInfrastrukturNegatif),1);
  var otomasiMasyarakat = roundUp((persenMasyarakatPositif - persenMasyarakatNegatif),1);
  var otomasiKesehatan = roundUp((persenKesehatanPositif - persenKesehatanNegatif),1);
  var otomasiTransportasi = roundUp((persenTransportasiPositif - persenTransportasiNegatif),1);
  var otomasiPemerintah = roundUp((persenPemerintahPositif - persenPemerintahNegatif),1);
  var otomasiPendidikan = roundUp((persenPendidikanPositif - persenPendidikanNegatif),1);
  var otomasiTeknologi = roundUp((persenTeknologiPositif - persenTeknologiNegatif),1);

  var valueOtomasi = [otomasiEnergi,otomasiInfrastruktur,otomasiMasyarakat,otomasiKesehatan,otomasiTransportasi,otomasiPemerintah,otomasiPendidikan,otomasiTeknologi];
// ======================================== //
// Grafik line
// ======================================== //

  var tanggal = data.tanggal;
  zingchart.THEME="classic";

  var myConfig = {
    "background-color":"white",
    "type":"line",
    "title":{
        "text":"Visualisasi Naive Bayes",
        "color":"#333",
        "background-color":"white",
        "width":"92%",
        "text-align":"center",
    },
    "legend":{
          "layout":"4x4",
          "margin-top":"7%",
          "margin-left": "23%",
          "border-width":"0",
          "shadow":false,
          "marker":{
              "cursor":"hand",
              "border-width":"0"
          },
          "background-color":"#ffe6e6",
          "border-width":2,
          "border-color":"red",
          "item":{
              "cursor":"hand"
          },
          "toggle-action":"remove"
      },
    "scaleX":{
          "values":tanggal,
          "max-items":8
    },
    "scaleY":{
          "line-color":"#333"
    },
      "tooltip":{
          "text":"%t: %v outbreaks in %k"
      },
    "plot":{
          "line-width":3,
          "marker":{
              "size":2
          },
          "selection-mode":"multiple",
          "background-mode":"graph",
          "selected-state":{
              "line-width":4
          },
          "background-state":{
              "line-color":"#eee",
              "marker":{
                  "background-color":"none"
              }
          }
    },
      "plotarea":{
          "margin":"30% 15% 10% 7%"
      },
      "series":[
          {
              "values": data.data.Energi.sentimenPositif,
              "text":"Energi Positif",
              "line-color":"#a6cee3",
              "marker":{
                  "background-color":"#a6cee3",
                  "border-color":"#a6cee3"
              }
          },
          {
              "values": data.data.Energi.sentimenNegatif,
              "text":"Energi Negatif",
              "line-color":"#1f78b4",
              "marker":{
                  "background-color":"#1f78b4",
                  "border-color":"#1f78b4"
              }
          },
          {
              "values": data.data.Infrastruktur.sentimenPositif,
              "text":"Infrastruktur Positif",
              "line-color":"#b2df8a",
              "marker":{
                  "background-color":"#b2df8a",
                  "border-color":"#b2df8a"
              }
          },
          {
              "values":data.data.Infrastruktur.sentimenNegatif,
              "text":"Infrastruktur Negatif",
              "line-color":"#33a02c",
              "marker":{
                  "background-color":"#33a02c",
                  "border-color":"#33a02c"
              }
          },
          {
              "values":data.data.Masyarakat.sentimenPositif,
              "text":"Masyarakat Positif",
              "line-color":"#fb9a99",
              "marker":{
                  "background-color":"#fb9a99",
                  "border-color":"#fb9a99"
              }
          },
          {
              "values":data.data.Masyarakat.sentimenNegatif,
              "text":"Masyarakat Negatif",
              "line-color":"#e31a1c",
              "marker":{
                  "background-color":"#e31a1c",
                  "border-color":"#e31a1c"
              }
          },
          {
              "values":data.data.Kesehatan.sentimenPositif,
              "text":"Kesehatan Positif",
              "line-color":"#fdbf6f",
              "marker":{
                  "background-color":"#fdbf6f",
                  "border-color":"#fdbf6f"
              }
          },
          {
              "values":data.data.Kesehatan.sentimenNegatif,
              "text":"Kesehatan Negatif",
              "line-color":"#ff7f00",
              "marker":{
                  "background-color":"#ff7f00",
                  "border-color":"#ff7f00"
              }
          },
          {
              "values":data.data.Transportasi.sentimenPositif,
              "text":"Transportasi Positif",
              "line-color":"#cab2d6",
              "marker":{
                  "background-color":"#cab2d6",
                  "border-color":"#cab2d6"
              }
          },
          {
              "values":data.data.Transportasi.sentimenNegatif,
              "text":"Transportasi Negatif",
              "line-color":"#ffff99",
              "marker":{
                  "background-color":"#ffff99",
                  "border-color":"#ffff99"
              }
          },
          {
              "values":data.data.Pemerintah.sentimenPositif,
              "text":"Pemerintah Positif",
              "line-color":"#6a3d9a",
              "marker":{
                  "background-color":"#6a3d9a",
                  "border-color":"#6a3d9a"
              }
          },
          {
              "values":data.data.Pemerintah.sentimenNegatif,
              "text":"Pemerintah Negatif",
              "line-color":"#b15928",
              "marker":{
                  "background-color":"#b15928",
                  "border-color":"#b15928"
              }
          },
          {
              "values":data.data.Pendidikan.sentimenPositif,
              "text":"Pendidikan Positif"
          },
          {
              "values":data.data.Pendidikan.sentimenNegatif,
              "text":"Pendidikan Negatif"
          },
          {
              "values":data.data.Teknologi.sentimenPositif,
              "text":"Teknologi Positif"
          },
          {
              "values":data.data.Teknologi.sentimenNegatif,
              "text":"Teknologi Negatif"
          }
    ]
  };

  zingchart.render({
    id : 'grafikAreaBayes',
    data : myConfig,
    height: 500,
    width: 1200
  });


// =========================================== //
// Grafik Pie
// =========================================== //

  // var configGrafikPie = {
  //   type: "pie",
  //   backgroundColor: 'none',
  //   plot: {
  //     borderColor: "#2B313B",
  //     borderWidth: 5,
  //     // slice: 90,
  //     valueBox: {
  //       placement: 'out',
  //       text: '%t\n%npv%',
  //       fontFamily: "Open Sans"
  //     },
  //     tooltip:{
  //       fontSize: '18',
  //       fontFamily: "Open Sans",
  //       padding: "5 10",
  //       text: "%npv%"
  //     },
  //     animation:{
  //       effect: 2,
  //       method: 5,
  //       speed: 900,
  //       sequence: 1,
  //       delay: 3000
  //     }
  //   },
  //   title: {
  //     fontColor: "#004bb9",
  //     text: 'Persentase Sentimen NB',
  //     align: "center",
  //     offsetX: 10,
  //     fontFamily: "Open Sans",
  //     fontSize: 25,
  //     backgroundColor: 'none',
  //     width:"100%",
  //   },
  //   plotarea: {
  //     margin: "70 0 0 0",
  //   },
  //   series : [
  //     {
  //       values : [jmlEnergiPositif],
  //       text: "Energi Positif",
  //       backgroundColor: '#FFCB45',
  //     },
  //     {
  //       values : [jmlEnergiNegatif],
  //       text: "Energi Negatif",
  //       backgroundColor: '#FF3434',
  //     },
  //     {
  //       values : [jmlInfrastrukturPositif],
  //       text: "Infrastruktur Positif",
  //     },
  //     {
  //       values : [jmlInfrastrukturNegatif],
  //       text: "Infrastruktur Negatif",
  //     },
  //     {
  //       values : [jmlMasyarakatPositif],
  //       text: "Masyarakat Positif",
  //     },
  //     {
  //       values : [jmlMasyarakatNegatif],
  //       text: "Masyarakat Negatif",
  //     },
  //     {
  //       values : [jmlKesehatanPositif],
  //       text: "Kesehatan Positif",
  //     },
  //     {
  //       values : [jmlKesehatanNegatif],
  //       text: "Kesehatan Negatif",
  //     },
  //     {
  //       values : [jmlTransportasiPositif],
  //       text: "Transportasi Positif",
  //     },
  //     {
  //       values : [jmlTransportasiNegatif],
  //       text: "Transportasi Negatif",
  //     },
  //     {
  //       values : [jmlPemerintahPositif],
  //       text: "Pemerintah Positif",
  //     },
  //     {
  //       values : [jmlPemerintahNegatif],
  //       text: "Pemerintah Negatif",
  //     },
  //     {
  //       values : [jmlPendidikanPositif],
  //       text: "Pendidikan Positif",
  //     },
  //     {
  //       values : [jmlPendidikanNegatif],
  //       text: "Pendidikan Negatif",
  //     },
  //     {
  //       values : [jmlTeknologiPositif],
  //       text: "Teknologi Positif",
  //     },
  //     {
  //       values : [jmlTeknologiNegatif],
  //       text: "Teknologi Negatif",
  //     }
  //   ]
  // };

  // zingchart.render({
  //   id : 'grafikPieBayes',
  //   data : configGrafikPie,
  //   height: '90%',
  //   width: '100%'
  // });



  // =================================================================== //
  // ===================  Grafif New  ================================== //
  // =================================================================== //




  var mySeries = [
      {
        values : [jmlEnergiPositif],
        text: "Energi Positif",
        backgroundColor: '#FFCB45',
      },
      {
        values : [jmlEnergiNegatif],
        text: "Energi Negatif",
        backgroundColor: '#FF3434',
      },
      {
        values : [jmlInfrastrukturPositif],
        text: "Infrastruktur Positif",
      },
      {
        values : [jmlInfrastrukturNegatif],
        text: "Infrastruktur Negatif",
      },
      {
        values : [jmlMasyarakatPositif],
        text: "Masyarakat Positif",
      },
      {
        values : [jmlMasyarakatNegatif],
        text: "Masyarakat Negatif",
      },
      {
        values : [jmlKesehatanPositif],
        text: "Kesehatan Positif",
      },
      {
        values : [jmlKesehatanNegatif],
        text: "Kesehatan Negatif",
      },
      {
        values : [jmlTransportasiPositif],
        text: "Transportasi Positif",
      },
      {
        values : [jmlTransportasiNegatif],
        text: "Transportasi Negatif",
      },
      {
        values : [jmlPemerintahPositif],
        text: "Pemerintah Positif",
      },
      {
        values : [jmlPemerintahNegatif],
        text: "Pemerintah Negatif",
      },
      {
        values : [jmlPendidikanPositif],
        text: "Pendidikan Positif",
      },
      {
        values : [jmlPendidikanNegatif],
        text: "Pendidikan Negatif",
      },
      {
        values : [jmlTeknologiPositif],
        text: "Teknologi Positif",
      },
      {
        values : [jmlTeknologiNegatif],
        text: "Teknologi Negatif",
      }
    
  ];  
   
  var myConfigPieNew = {
    "type":"pie",
    "background-color":"none",
    "title":{
      "text":"Persentase Naive Bayes",
      "color": "black",
      "background-color":"none",
      "fontSize": "16"
    },
    "legend":{
      "x":"75%",
      "y":"25%",
      "border-width":1,
      "border-color":"gray",
      "border-radius":"5px",
      "header":{
        "text":"Legend",
        "font-family":"Georgia",
        "font-size":12,
        "font-color":"#3333cc",
        "font-weight":"normal"
      },
      "marker":{
        "type":"circle"
      },
      "toggle-action":"hide",
      "minimize":true,
      "icon":{
        "line-color":"#9999ff"
      },
      "max-items":8,
      "overflow":"scroll"
    },
    "plotarea":{
      "margin-right":"30%",
      "margin-top":"15%"
    },
    "plot":{
      "value-box":{
        "text":"%v",
        "font-size":12,
        "font-family":"Georgia",
        "font-weight":"normal",
            "placement":"out",
            "font-color":"gray",
      },
      "tooltip":{
        "text":"%t: %v (%npv%)",
        "font-color":"black",
        "font-family":"Georgia",
        "text-alpha":1,
        "background-color":"white",
        "alpha":0.7,
        "border-width":1,
        "border-color":"#cccccc",
        "line-style":"dotted",
        "border-radius":"10px",
        "padding":"10%",
        "placement":"node:center"
      },
      "border-width":1,
      "border-color":"#cccccc",
      "line-style":"dotted"
    },
    "series": mySeries
   
  };
   
  zingchart.render({ 
    
    
    id : 'grafikPieBayes',
    data : myConfigPieNew, 
    height: '90%',
    width: '100%'
  });



// =========================================================================== //
// ======================= GRAFIK OTOMASI SMART CITY ========================= //
// =========================================================================== //

  var configGrafikOtomasi = {
    type : 'radar',
    "background-color" : 'none',
    "title": {
      "text": "Otomasi Smart City Naive Bayes",
      "font-family": "Arial",
      "font-weight": "bold",
      "font-size": "16px",
      "font-color": "black",
      "background-color": "none",
      "text-align": "center",
      "padding": "20px 20px"
    },
    "legend": {
      "draggable":true,
      "drag-handler":"icon", //"header" (default) or "icon"
      "icon":{
        "line-color":"white"
      },
      "x": "800px",
      "y": "60px",
      "width": "155px",
      "padding": "10px 12px",
      "background-color": "#d3d3d3",
      "shadow": false,
      "item": {
        "font-family": "Arial",
        "font-size": "12px",
        "font-weight": "normal",
        "font-color": "#000000"
      }
    },
    plot : {
      aspect : 'area',
      lineWidth : 2
    },
    scaleV : {
      values : '0:30:10',
      format : '%v%',
      item : {
        fontColor : '#607D8B',
        backgroundColor : "white",
        borderColor : "#aeaeae",
        borderWidth : 1,
        padding : 3,
        borderRadius : 10,
        offsetX : 5
      },
      refLine : {
        lineColor : '#607D8B'
      },
      tick : {
        lineColor : '#607D8B',
        length : 5,
        size : 5
      },
      guide : {
        lineColor : "#8b9fa8",
        lineStyle : 'solid',
        
      }
    },
    series : [
      {
        values : [6.25, 1.25, 2.5, 4.16, 4.16, 4.16, 4.16, 4.16],
        "text": "Otomasi Minimal",
        backgroundColor : '#689F38',
        lineColor : '#33691E'
        
      },
      {
        values : valueOtomasi,
        "text": "Otomasi Sentimen",
        backgroundColor : '#0288D1',
        lineColor : '#01579B'
      }
    ],
    scaleK : {
      "values": [
                "Energi",
                "Infrastruktur",
                "Masyarakat",
                "Kesehatan",
                "Transportasi",
                "Pemerintah",
                "Pendidikan",
                "Teknologi"
            ],
    }
  };
   
  zingchart.render({ 
    id : 'grafikOtomasiBayes', 
    data : configGrafikOtomasi, 
    height: '90%', 
    width: '100%' 
  });



});
// =========================== END OF BAYES ============================= //
// 








// =================================== //
// Visualisasi Metode KNN
// =================================== //
$.get("model/data_visualisasi_json_knn.php", function(data, status){
  var jmlEnergiPositif = 0;
  var jmlEnergiNegatif = 0;
  var jmlInfrastrukturPositif = 0;
  var jmlInfrastrukturNegatif = 0;
  var jmlMasyarakatPositif = 0;
  var jmlMasyarakatNegatif = 0;
  var jmlKesehatanPositif = 0;
  var jmlKesehatanNegatif = 0;
  var jmlTransportasiPositif = 0;
  var jmlTransportasiNegatif = 0;
  var jmlPemerintahPositif = 0;
  var jmlPemerintahNegatif = 0;
  var jmlPendidikanPositif = 0;
  var jmlPendidikanNegatif = 0;
  var jmlTeknologiPositif = 0;
  var jmlTeknologiNegatif = 0;

  for (var i = 0; i < data.tanggal.length; i++) {
    
    jmlEnergiPositif += data.data.Energi.sentimenPositif[i];
    jmlEnergiNegatif += data.data.Energi.sentimenNegatif[i];
    jmlInfrastrukturPositif += data.data.Infrastruktur.sentimenPositif[i];
    jmlInfrastrukturNegatif += data.data.Infrastruktur.sentimenNegatif[i];
    jmlMasyarakatPositif += data.data.Masyarakat.sentimenPositif[i];
    jmlMasyarakatNegatif += data.data.Masyarakat.sentimenNegatif[i];
    jmlKesehatanPositif += data.data.Kesehatan.sentimenPositif[i];
    jmlKesehatanNegatif += data.data.Kesehatan.sentimenNegatif[i];
    jmlTransportasiPositif += data.data.Transportasi.sentimenPositif[i];
    jmlTransportasiNegatif += data.data.Transportasi.sentimenNegatif[i];
    jmlPemerintahPositif += data.data.Pemerintah.sentimenPositif[i];
    jmlPemerintahNegatif += data.data.Pemerintah.sentimenNegatif[i];
    jmlPendidikanPositif += data.data.Pendidikan.sentimenPositif[i];
    jmlPendidikanNegatif += data.data.Pendidikan.sentimenNegatif[i];
    jmlTeknologiPositif += data.data.Teknologi.sentimenPositif[i];
    jmlTeknologiNegatif += data.data.Teknologi.sentimenNegatif[i];
  };

  var jmlSemuaSentimen = jmlEnergiPositif+jmlEnergiNegatif+jmlInfrastrukturPositif+jmlInfrastrukturNegatif+jmlMasyarakatPositif+jmlMasyarakatNegatif+jmlKesehatanPositif+jmlKesehatanNegatif+jmlTransportasiPositif+jmlTransportasiNegatif+jmlPemerintahPositif+jmlPemerintahNegatif+jmlPendidikanPositif+jmlPendidikanNegatif+jmlTeknologiPositif+jmlTeknologiNegatif;

  var persenEnergiPositif = (jmlEnergiPositif/jmlSemuaSentimen)*100;
  var persenEnergiNegatif = (jmlEnergiNegatif/jmlSemuaSentimen)*100;
  var persenInfrastrukturPositif = (jmlInfrastrukturPositif/jmlSemuaSentimen)*100;
  var persenInfrastrukturNegatif = (jmlInfrastrukturNegatif/jmlSemuaSentimen)*100;
  var persenMasyarakatPositif = (jmlMasyarakatPositif/jmlSemuaSentimen)*100;
  var persenMasyarakatNegatif = (jmlMasyarakatNegatif/jmlSemuaSentimen)*100;
  var persenKesehatanPositif = (jmlKesehatanPositif/jmlSemuaSentimen)*100;
  var persenKesehatanNegatif = (jmlKesehatanNegatif/jmlSemuaSentimen)*100;
  var persenTransportasiPositif = (jmlTransportasiPositif/jmlSemuaSentimen)*100;
  var persenTransportasiNegatif = (jmlTransportasiNegatif/jmlSemuaSentimen)*100;
  var persenPemerintahPositif = (jmlPemerintahPositif/jmlSemuaSentimen)*100;
  var persenPemerintahNegatif = (jmlPemerintahNegatif/jmlSemuaSentimen)*100;
  var persenPendidikanPositif = (jmlPendidikanPositif/jmlSemuaSentimen)*100;
  var persenPendidikanNegatif = (jmlPendidikanNegatif/jmlSemuaSentimen)*100;
  var persenTeknologiPositif = (jmlTeknologiPositif/jmlSemuaSentimen)*100;
  var persenTeknologiNegatif = (jmlTeknologiNegatif/jmlSemuaSentimen)*100;


  var otomasiEnergi = roundUp((persenEnergiPositif - persenEnergiNegatif),1);
  var otomasiInfrastruktur = roundUp((persenInfrastrukturPositif - persenInfrastrukturNegatif),1);
  var otomasiMasyarakat = roundUp((persenMasyarakatPositif - persenMasyarakatNegatif),1);
  var otomasiKesehatan = roundUp((persenKesehatanPositif - persenKesehatanNegatif),1);
  var otomasiTransportasi = roundUp((persenTransportasiPositif - persenTransportasiNegatif),1);
  var otomasiPemerintah = roundUp((persenPemerintahPositif - persenPemerintahNegatif),1);
  var otomasiPendidikan = roundUp((persenPendidikanPositif - persenPendidikanNegatif),1);
  var otomasiTeknologi = roundUp((persenTeknologiPositif - persenTeknologiNegatif),1);

  var valueOtomasi = [otomasiEnergi,otomasiInfrastruktur,otomasiMasyarakat,otomasiKesehatan,otomasiTransportasi,otomasiPemerintah,otomasiPendidikan,otomasiTeknologi];


// ======================================== //
// Grafik line
// ======================================== //

  var tanggal = data.tanggal;
  zingchart.THEME="classic";

  var myConfig = {
    "background-color":"white",
    "type":"line",
    "title":{
        "text":"Metode K-Nearest Neighbor",
        "color":"#333",
        "background-color":"white",
        "width":"92%",
        "text-align":"center",
    },
    "legend":{
          "layout":"4x4",
          "margin-top":"7%",
          "margin-left": "23%",
          "border-width":"0",
          "shadow":false,
          "marker":{
              "cursor":"hand",
              "border-width":"0"
          },
          "background-color":"#ffe6e6",
          "border-width":2,
          "border-color":"red",
          "item":{
              "cursor":"hand"
          },
          "toggle-action":"remove"
      },
    "scaleX":{
          "values":tanggal,
          "max-items":8
    },
    "scaleY":{
          "line-color":"#333"
    },
      "tooltip":{
          "text":"%t: %v outbreaks in %k"
      },
    "plot":{
          "line-width":3,
          "marker":{
              "size":2
          },
          "selection-mode":"multiple",
          "background-mode":"graph",
          "selected-state":{
              "line-width":4
          },
          "background-state":{
              "line-color":"#eee",
              "marker":{
                  "background-color":"none"
              }
          }
    },
      "plotarea":{
          "margin":"30% 15% 10% 7%"
      },
      "series":[
          {
              "values": data.data.Energi.sentimenPositif,
              "text":"Energi Positif",
              "line-color":"#a6cee3",
              "marker":{
                  "background-color":"#a6cee3",
                  "border-color":"#a6cee3"
              }
          },
          {
              "values": data.data.Energi.sentimenNegatif,
              "text":"Energi Negatif",
              "line-color":"#1f78b4",
              "marker":{
                  "background-color":"#1f78b4",
                  "border-color":"#1f78b4"
              }
          },
          {
              "values": data.data.Infrastruktur.sentimenPositif,
              "text":"Infrastruktur Positif",
              "line-color":"#b2df8a",
              "marker":{
                  "background-color":"#b2df8a",
                  "border-color":"#b2df8a"
              }
          },
          {
              "values":data.data.Infrastruktur.sentimenNegatif,
              "text":"Infrastruktur Negatif",
              "line-color":"#33a02c",
              "marker":{
                  "background-color":"#33a02c",
                  "border-color":"#33a02c"
              }
          },
          {
              "values":data.data.Masyarakat.sentimenPositif,
              "text":"Masyarakat Positif",
              "line-color":"#fb9a99",
              "marker":{
                  "background-color":"#fb9a99",
                  "border-color":"#fb9a99"
              }
          },
          {
              "values":data.data.Masyarakat.sentimenNegatif,
              "text":"Masyarakat Negatif",
              "line-color":"#e31a1c",
              "marker":{
                  "background-color":"#e31a1c",
                  "border-color":"#e31a1c"
              }
          },
          {
              "values":data.data.Kesehatan.sentimenPositif,
              "text":"Kesehatan Positif",
              "line-color":"#fdbf6f",
              "marker":{
                  "background-color":"#fdbf6f",
                  "border-color":"#fdbf6f"
              }
          },
          {
              "values":data.data.Kesehatan.sentimenNegatif,
              "text":"Kesehatan Negatif",
              "line-color":"#ff7f00",
              "marker":{
                  "background-color":"#ff7f00",
                  "border-color":"#ff7f00"
              }
          },
          {
              "values":data.data.Transportasi.sentimenPositif,
              "text":"Transportasi Positif",
              "line-color":"#cab2d6",
              "marker":{
                  "background-color":"#cab2d6",
                  "border-color":"#cab2d6"
              }
          },
          {
              "values":data.data.Transportasi.sentimenNegatif,
              "text":"Transportasi Negatif",
              "line-color":"#ffff99",
              "marker":{
                  "background-color":"#ffff99",
                  "border-color":"#ffff99"
              }
          },
          {
              "values":data.data.Pemerintah.sentimenPositif,
              "text":"Pemerintah Positif",
              "line-color":"#6a3d9a",
              "marker":{
                  "background-color":"#6a3d9a",
                  "border-color":"#6a3d9a"
              }
          },
          {
              "values":data.data.Pemerintah.sentimenNegatif,
              "text":"Pemerintah Negatif",
              "line-color":"#b15928",
              "marker":{
                  "background-color":"#b15928",
                  "border-color":"#b15928"
              }
          },
          {
              "values":data.data.Pendidikan.sentimenPositif,
              "text":"Pendidikan Positif"
          },
          {
              "values":data.data.Pendidikan.sentimenNegatif,
              "text":"Pendidikan Negatif"
          },
          {
              "values":data.data.Teknologi.sentimenPositif,
              "text":"Teknologi Positif"
          },
          {
              "values":data.data.Teknologi.sentimenNegatif,
              "text":"Teknologi Negatif"
          }
    ]
  };

  zingchart.render({
    id : 'grafikAreaKnn',
    data : myConfig,
    height: 500,
    width: 1200
  });


// =========================================== //
// Grafik Pie
// =========================================== //

// var configGrafikPie = {
//     type: "pie",
//     backgroundColor: 'none',
//     plot: {
//       borderColor: "#2B313B",
//       borderWidth: 5,
//       // slice: 90,
//       valueBox: {
//         placement: 'out',
//         text: '%t\n%npv%',
//         fontFamily: "Open Sans"
//       },
//       tooltip:{
//         fontSize: '18',
//         fontFamily: "Open Sans",
//         padding: "5 10",
//         text: "%npv%"
//       },
//       animation:{
//         effect: 2,
//         method: 5,
//         speed: 900,
//         sequence: 1,
//         delay: 3000
//       }
//     },
//     title: {
//       fontColor: "black",
//       text: 'Persentase Sentimen KNN',
//       align: "center",
//       offsetX: 10,
//       fontFamily: "Open Sans",
//       fontSize: 16,
//       backgroundColor: 'none'
//     },
//     plotarea: {
//       margin: "70 0 0 0",
//     },
//     series : [
//       {
//         values : [jmlEnergiPositif],
//         text: "Energi Positif",
//         backgroundColor: '#FFCB45',
//       },
//       {
//         values : [jmlEnergiNegatif],
//         text: "Energi Negatif",
//         backgroundColor: '#FF3434',
//       },
//       {
//         values : [jmlInfrastrukturPositif],
//         text: "Infrastruktur Positif",
//       },
//       {
//         values : [jmlInfrastrukturNegatif],
//         text: "Infrastruktur Negatif",
//       },
//       {
//         values : [jmlMasyarakatPositif],
//         text: "Masyarakat Positif",
//       },
//       {
//         values : [jmlMasyarakatNegatif],
//         text: "Masyarakat Negatif",
//       },
//       {
//         values : [jmlKesehatanPositif],
//         text: "Kesehatan Positif",
//       },
//       {
//         values : [jmlKesehatanNegatif],
//         text: "Kesehatan Negatif",
//       },
//       {
//         values : [jmlTransportasiPositif],
//         text: "Transportasi Positif",
//       },
//       {
//         values : [jmlTransportasiNegatif],
//         text: "Transportasi Negatif",
//       },
//       {
//         values : [jmlPemerintahPositif],
//         text: "Pemerintah Positif",
//       },
//       {
//         values : [jmlPemerintahNegatif],
//         text: "Pemerintah Negatif",
//       },
//       {
//         values : [jmlPendidikanPositif],
//         text: "Pendidikan Positif",
//       },
//       {
//         values : [jmlPendidikanNegatif],
//         text: "Pendidikan Negatif",
//       },
//       {
//         values : [jmlTeknologiPositif],
//         text: "Teknologi Positif",
//       },
//       {
//         values : [jmlTeknologiNegatif],
//         text: "Teknologi Negatif",
//       }
//     ]
//   };

//   zingchart.render({
//     id : 'grafikPieKnn',
//     data : configGrafikPie,
//     height: '90%',
//     width: '100%'
//   });


  var mySeries = [
      {
        values : [jmlEnergiPositif],
        text: "Energi Positif",
        backgroundColor: '#FFCB45',
      },
      {
        values : [jmlEnergiNegatif],
        text: "Energi Negatif",
        backgroundColor: '#FF3434',
      },
      {
        values : [jmlInfrastrukturPositif],
        text: "Infrastruktur Positif",
      },
      {
        values : [jmlInfrastrukturNegatif],
        text: "Infrastruktur Negatif",
      },
      {
        values : [jmlMasyarakatPositif],
        text: "Masyarakat Positif",
      },
      {
        values : [jmlMasyarakatNegatif],
        text: "Masyarakat Negatif",
      },
      {
        values : [jmlKesehatanPositif],
        text: "Kesehatan Positif",
      },
      {
        values : [jmlKesehatanNegatif],
        text: "Kesehatan Negatif",
      },
      {
        values : [jmlTransportasiPositif],
        text: "Transportasi Positif",
      },
      {
        values : [jmlTransportasiNegatif],
        text: "Transportasi Negatif",
      },
      {
        values : [jmlPemerintahPositif],
        text: "Pemerintah Positif",
      },
      {
        values : [jmlPemerintahNegatif],
        text: "Pemerintah Negatif",
      },
      {
        values : [jmlPendidikanPositif],
        text: "Pendidikan Positif",
      },
      {
        values : [jmlPendidikanNegatif],
        text: "Pendidikan Negatif",
      },
      {
        values : [jmlTeknologiPositif],
        text: "Teknologi Positif",
      },
      {
        values : [jmlTeknologiNegatif],
        text: "Teknologi Negatif",
      }
    
  ];  
   
  var myConfigPieNew = {
    "type":"pie",
    "background-color":"none",
    "title":{
      "text":"Persentase K-Nearest Neighbor",
      "color": "black",
      "background-color":"none",
      "fontSize": "16"
    },
    "legend":{
      "x":"75%",
      "y":"25%",
      "border-width":1,
      "border-color":"gray",
      "border-radius":"5px",
      "header":{
        "text":"Legend",
        "font-family":"Georgia",
        "font-size":12,
        "font-color":"#3333cc",
        "font-weight":"normal"
      },
      "marker":{
        "type":"circle"
      },
      "toggle-action":"hide",
      "minimize":true,
      "icon":{
        "line-color":"#9999ff"
      },
      "max-items":8,
      "overflow":"scroll"
    },
    "plotarea":{
      "margin-right":"30%",
      "margin-top":"15%"
    },
    "plot":{
      "value-box":{
        "text":"%v",
        "font-size":12,
        "font-family":"Georgia",
        "font-weight":"normal",
            "placement":"out",
            "font-color":"gray",
      },
      "tooltip":{
        "text":"%t: %v (%npv%)",
        "font-color":"black",
        "font-family":"Georgia",
        "text-alpha":1,
        "background-color":"white",
        "alpha":0.7,
        "border-width":1,
        "border-color":"#cccccc",
        "line-style":"dotted",
        "border-radius":"10px",
        "padding":"10%",
        "placement":"node:center"
      },
      "border-width":1,
      "border-color":"#cccccc",
      "line-style":"dotted"
    },
    "series": mySeries
   
  };
   
  zingchart.render({ 
    
    
    id : 'grafikPieKnn',
    data : myConfigPieNew, 
    height: '90%',
    width: '100%'
  });


// =========================================================================== //
// ======================= GRAFIK OTOMASI SMART CITY ========================= //
// =========================================================================== //

  var configGrafikOtomasiKnn = {
    type : 'radar',
    "background-color" : 'none',
    "title": {
      "text": "Otomasi Smart City K-Nearest Neighbor",
      "font-family": "Arial",
      "font-weight": "bold",
      "font-size": "16px",
      "font-color": "black",
      "background-color": "none",
      "text-align": "center",
      "padding": "20px 20px"
    },
    "legend": {
      "draggable":true,
      "drag-handler":"icon", //"header" (default) or "icon"
      "icon":{
        "line-color":"white"
      },
      "x": "800px",
      "y": "60px",
      "width": "155px",
      "padding": "10px 12px",
      "background-color": "#d3d3d3",
      "shadow": false,
      "item": {
        "font-family": "Arial",
        "font-size": "12px",
        "font-weight": "normal",
        "font-color": "#000000"
      }
    },
    plot : {
      aspect : 'area',
      lineWidth : 2
    },
    scaleV : {
      values : '0:30:10',
      format : '%v%',
      item : {
        fontColor : '#607D8B',
        backgroundColor : "white",
        borderColor : "#aeaeae",
        borderWidth : 1,
        padding : 3,
        borderRadius : 10,
        offsetX : 5
      },
      refLine : {
        lineColor : '#607D8B'
      },
      tick : {
        lineColor : '#607D8B',
        length : 5,
        size : 5
      },
      guide : {
        lineColor : "#8b9fa8",
        lineStyle : 'solid',
        
      }
    },
    series : [
      {
        values : [6.25, 1.25, 2.5, 4.16, 4.16, 4.16, 4.16, 4.16],
        "text": "Otomasi Minimal",
        backgroundColor : '#689F38',
        lineColor : '#33691E'
        
      },
      {
        values : valueOtomasi,
        "text": "Otomasi Sentimen",
        backgroundColor : '#0288D1',
        lineColor : '#01579B'
      }
    ],
    scaleK : {
      "values": [
                "Energi",
                "Infrastruktur",
                "Masyarakat",
                "Kesehatan",
                "Transportasi",
                "Pemerintah",
                "Pendidikan",
                "Teknologi"
            ],
    }
  };
   
  zingchart.render({ 
    id : 'grafikOtomasiKnn', 
    data : configGrafikOtomasiKnn, 
    height: '90%', 
    width: '100%' 
  });



});
// ========================================================================================= //
// ==============================  END OF KNN ============================================== //
// ========================================================================================= //





// ===================================================== //
// Grafik Akurasi
// ===================================================== //

$.get("model/data_akurasi_json.php", function(data, status){


  var configAkurasi = {
      "type":"mixed",
      "title":{
        "text":"Akurasi Naive Bayes + Information Gain",
        "fontSize": 16,
      },
      "scale-x":{
        "labels":data.threshold,
        "label":{
          "text":"Threshold"
        }
      },
      "scale-y":{
        "values":"0:23000:1000",
        "label":{
          "text":"Waktu (s)"
        }
      },
      "scale-y-2":{
        "values":"0:100:10",
        "label":{
          "text":"Persentase"
        }
      },
      "series":[
        {
          "type":"area",
          "scales":"scale-x,scale-y",
          "values": data.waktu,
          "marker":{
            "size":3
          }
        },
        {
          "type":"line",
          "scales":"scale-x,scale-y-2",
          "values": data.akurasi,
          "marker":{
            "size":3
          }
        }
      ]
    };

    zingchart.render({
      id : 'grafikAkurasiBayes',
      data : configAkurasi,
      height: '90%',
      width: '100%'
    });


});


