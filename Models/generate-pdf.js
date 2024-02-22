const puppeteer = require('puppeteer');
const url = process.argv[2];
const outputPath = process.argv[3];

async function generatePDF() {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto(url, {waitUntil: 'networkidle2'});
    await page.pdf({path: outputPath, format: 'A4'});
    await browser.close();
}

generatePDF();
