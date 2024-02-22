const express = require('express');
const puppeteer = require('puppeteer');
const app = express();
const port = 3000;

app.get('/generate-pdf', async (req, res) => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.goto('https://example.com', {waitUntil: 'networkidle2'});
  const pdf = await page.pdf({ format: 'A4' });
  await browser.close();

  res.contentType("application/pdf");
  res.send(pdf);
});

app.listen(port, () => {
  console.log(`PDF generator listening at http://localhost:${port}`);
});
