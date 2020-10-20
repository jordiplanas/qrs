# qrs

## DATA PARSER

Data spreadsheet: https://docs.google.com/spreadsheets/d/1xTIaoOW0tLNMg9P887WiCyYX--IJQS3JHkrsVld0O3Y/edit#gid=0

Download the spreadsheet above as a .csv file and rename it `data.csv`.
Add the `data.csv` file in the `parser/in` folder.
Open the terminal and run `npm run parse-data` from the root folder of the project.
The resulting `.json` data file will be written to the `data/` folder.

## COPY PARSER

Copy spreasheet: https://docs.google.com/spreadsheets/d/12Qe8FfyISXyeApEOBy9QlDaVALjCmB8PdzTlmL0Vn2A/edit#gid=0

Download the spreadsheet above as a .csv file and rename it `copy.csv`.
Add the new `copy.csv` file in the `parser/in` folder.
Open the terminal and run `npm run parse-copy` from the root folder of the project.
The resulting `.json` copy files will be written to the `data/copy/` folder.