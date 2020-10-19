//
// Copy Parser

// Link to copy doc: https://docs.google.com/spreadsheets/d/12Qe8FfyISXyeApEOBy9QlDaVALjCmB8PdzTlmL0Vn2A/edit#gid=0

const path = require("path");
const csv = require("csvtojson/v1");
const fs = require("fs-extra");

const inPath = path.resolve(__dirname, "in", "copy.csv");
const outPath = "./data/copy/";
const langKeys = {
  es: 1,
  ca: 2
}

for (const langKey in langKeys){
  const outputData = {};
  csv({
    ignoreEmpty: true,
    trim: true,
  }).fromFile(inPath)
    .on('csv',(csvRow)=>{
      if(csvRow[0] !== ""){
        outputData[csvRow[0]] = csvRow[langKeys[langKey]];
      }
    }).on('done',()=>{
      fs.writeFileSync(`${outPath}${langKey}.json`, JSON.stringify(outputData), {
        encoding: "utf8"
      })
      console.log("ending parse File written", `${outPath}${langKey}.json`);
    })
}