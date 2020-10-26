//
// Data Parser

// Link to data doc: https://docs.google.com/spreadsheets/d/1xTIaoOW0tLNMg9P887WiCyYX--IJQS3JHkrsVld0O3Y/edit#gid=0

const path = require("path");
const csv = require("csvtojson/v1");
const fs = require("fs-extra");

const inPath = path.resolve(__dirname, "in", "data.csv");
const outPath = "./data/data.json";
const outputData = {};

csv({
  ignoreEmpty: true,
  trim: true,
}).fromFile(inPath)
  .on('csv',(csvRow)=>{
    const obj = {};
    obj['points'] = csvRow[1];
    obj['embedded'] = csvRow[2];
    obj['ar'] = csvRow[3];
    outputData[csvRow[0]] = obj;
    // console.log(outputData);
  }).on('done',()=>{
    fs.writeFileSync(`${outPath}`, JSON.stringify(outputData), {
      encoding: "utf8"
    })
    console.log("ending parse File written", `${outPath}`);
  })