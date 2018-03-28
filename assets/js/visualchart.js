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


// ======================================== //
// Grafik line
// ======================================== //

  var tanggal = data.tanggal;
  zingchart.THEME="classic";

  var myConfig = {
    "background-color":"white",
    "type":"line",
    "title":{
        "text":"",
        "color":"#333",
        "background-color":"white",
        "width":"85%",
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
    id : 'grafikArea',
    data : myConfig,
    height: 500,
    width: 1200
  });


// =========================================== //
// Grafik Pie
// =========================================== //

var configGrafikPie = {
    type: "pie",
    backgroundColor: 'none',
    plot: {
      borderColor: "#2B313B",
      borderWidth: 5,
      // slice: 90,
      valueBox: {
        placement: 'out',
        text: '%t\n%npv%',
        fontFamily: "Open Sans"
      },
      tooltip:{
        fontSize: '18',
        fontFamily: "Open Sans",
        padding: "5 10",
        text: "%npv%"
      },
      animation:{
        effect: 2,
        method: 5,
        speed: 900,
        sequence: 1,
        delay: 3000
      }
    },
    title: {
      fontColor: "#004bb9",
      text: 'Persentase Sentimen',
      align: "center",
      offsetX: 10,
      fontFamily: "Open Sans",
      fontSize: 25,
      backgroundColor: 'none'
    },
    plotarea: {
      margin: "70 0 0 0",
    },
    series : [
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
    ]
  };

  zingchart.render({
    id : 'grafikPie',
    data : configGrafikPie,
    height: '90%',
    width: '90%'
  });

});

// ===================================================== //
// Grafik Akurasi
// ===================================================== //

$.get("model/data_akurasi_json.php", function(data, status){


  var configAkurasi = {
      "type":"mixed",
      "title":{
        "text":"Akurasi"
      },
      "scale-x":{
        "labels":data.threshold,
        "label":{
          "text":"Threshold"
        }
      },
      "scale-y":{
        "values":"0:700:100",
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
      id : 'grafikAkurasi',
      data : configAkurasi,
      height: '90%',
      width: '100%'
    });


});