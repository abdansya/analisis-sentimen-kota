$.get("model/model-visual.php", function(data, status){
  var tanggal = data.tanggal;
  zingchart.THEME="classic";

  var myConfig = {
    "background-color":"white",
    "type":"line",
    "title":{
        "text":"Analisis Satu Pekan",
        "color":"#333",
        "background-color":"white",
        "width":"85%",
        "text-align":"center",
    },
    "legend":{
          "layout":"4x4",
          "margin-top":"7%",
          "margin-left": "20%",
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


});