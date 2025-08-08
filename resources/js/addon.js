// Wait for DOM to be ready and check if we're on a form blueprint edit page
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the form blueprint edit page
    const currentUrl = window.location.href;
    if (!currentUrl.includes('/forms/') || !currentUrl.includes('/blueprint')) {
        return;
    }

    // Extract form handle from the URL
    const urlParts = currentUrl.split('/');
    const formsIndex = urlParts.indexOf('forms');
    if (formsIndex === -1 || formsIndex + 1 >= urlParts.length) {
        return;
    }
    
    const formHandle = urlParts[formsIndex + 1];
    
    // Check if this form has Zapier webhooks
    fetch(`/cp/zapier-blueprint-alerts/check/${formHandle}`)
        .then(response => response.json())
        .then(data => {
            if (data.hasWebhooks) {
                showZapierAlert();
            }
        })
        .catch(error => {
            console.log('Could not check for Zapier webhooks:', error);
        });
});

function showZapierAlert() {
    // Create the alert element
    const alert = document.createElement('div');
    alert.className = 'p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 border border-yellow-300';
    alert.innerHTML = '⚠️ <strong>Heads up!</strong> This form has Zapier webhooks. If you change the fields, make sure to update the Zap in Zapier, or it will break!';
    
    // Find the main content area and insert the alert at the top
    const mainContent = document.querySelector('.main-content') || 
                       document.querySelector('.content') || 
                       document.querySelector('[data-v-'] .p-0') ||
                       document.querySelector('main');
    
    if (mainContent) {
        // Insert as the first child of the main content
        mainContent.insertBefore(alert, mainContent.firstChild);
    } else {
        // Fallback: insert after the breadcrumb or at the top of the page
        const breadcrumb = document.querySelector('.breadcrumb') || 
                          document.querySelector('nav[aria-label="breadcrumb"]');
        
        if (breadcrumb) {
            breadcrumb.parentNode.insertBefore(alert, breadcrumb.nextSibling);
        }
    }
}