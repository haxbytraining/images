<!DOCTYPE html>
<html>
    <title>Word Cloud - Leadership and Management</title>
<head>
  <script src="https://cdn.jsdelivr.net/npm/vega@5.25.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/vega-lite@5.16.3"></script>
  <script src="https://cdn.jsdelivr.net/npm/vega-embed@6.23.0"></script>
</head>
<body>
  <div id="vis"/>
  <script>
    const spec = {
  "$schema": "https://vega.github.io/schema/vega/v5.json",
  "description": "A word cloud for the leadership and management programme.",
  "width": 800,
  "height": 400,
  "padding": 0,
  "data": [
    {
      "name": "table",
      "values": [
        "<?php $url='https://sheets.googleapis.com/v4/spreadsheets/1NPDDToJcwEh6reW3IQOJEo_MzOSiiLGjKkL1ptNMiiE/values/2022-23?alt=json&key=AIzaSyBGleujEZPzO5R3TWOhn7OdeE1jgrxby0k';$json=json_decode(file_get_contents($url));$rows=$json->values;foreach($rows as $row){echo implode($row),', ';} ?>"
      ],
      "transform": [
        {
          "type": "countpattern",
          "field": "data",
          "case": "upper",
          "pattern": "[\\w']{3,}",
          "stopwords": "(i|me)"
        },
        {
          "type": "formula",
          "as": "angle",
          "expr": "[-45, 0, 45][~~(random() * 3)]"
        },
        {
          "type": "formula",
          "as": "weight",
          "expr": "if(datum.text=='VEGA', 600, 300)"
        }
      ]
    }
  ],
  "scales": [
    {
      "name": "color",
      "type": "ordinal",
      "domain": {"data": "table", "field": "text"},
      "range": ["#d5a928", "#652c90", "#939597"]
    }
  ],
  "marks": [
    {
      "type": "text",
      "from": {"data": "table"},
      "encode": {
        "enter": {
          "text": {"field": "text"},
          "align": {"value": "center"},
          "baseline": {"value": "alphabetic"},
          "fill": {"scale": "color", "field": "text"}
        },
        "update": {"fillOpacity": {"value": 1}},
        "hover": {"fillOpacity": {"value": 0.5}}
      },
      "transform": [
        {
          "type": "wordcloud",
          "size": [800, 400],
          "text": {"field": "text"},
          "rotate": {"field": "datum.angle"},
          "font": "Helvetica Neue, Arial",
          "fontSize": {"field": "datum.count"},
          "fontWeight": {"field": "datum.weight"},
          "fontSizeRange": [12, 56],
          "padding": 2
        }
      ]
    }
  ],
  "config": {}
};
    vegaEmbed("#vis", spec, {mode: "vega"}).then(console.log).catch(console.warn);
  </script>
</body>
</html>