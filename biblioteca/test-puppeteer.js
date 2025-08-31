// test-puppeteer.js
import puppeteer from 'puppeteer';

(async () => {
    try {
        const browser = await puppeteer.launch();
        const page = await browser.newPage();
        await page.goto('https://example.com');
        await page.pdf({ path: 'example.pdf', format: 'A4' });
        await browser.close();
        console.log('PDF generated successfully!');
    } catch (error) {
        console.error('Error:', error);
    }
})();
