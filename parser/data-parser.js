//
// Data Parser

// Link to data doc: https://docs.google.com/spreadsheets/d/1xTIaoOW0tLNMg9P887WiCyYX--IJQS3JHkrsVld0O3Y/edit#gid=0

const path = require("path");
const csv = require("csvtojson");
const fs = require("fs-extra");

const inPath = path.resolve(__dirname, "in", "data.csv");
const outPath = "./data/"; // Output JSON

csv({
  includeColumns: /(param|points|embedded)/,
  ignoreEmpty: true
}).fromFile(inPath)
  .then((outputData) => {
    fs.writeFileSync(`${outPath}data.json`, JSON.stringify(outputData), {
      encoding: "utf8"
    });
    console.log("ending parse File written", `${outPath}data.json`);
  })