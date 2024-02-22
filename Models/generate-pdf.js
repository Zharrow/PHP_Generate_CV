const puppeteer = require('puppeteer');

async function generatePDF() {
    const url = 'http://localhost/Models/TemplateA.php';
    
    const outputPath = 'www\Saves\output.pdf';

    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto(url, { waitUntil: 'networkidle2' });
    await page.pdf({ path: outputPath, format: 'A4' });
    await browser.close();
}

generatePDF();
