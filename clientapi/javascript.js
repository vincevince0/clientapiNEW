function btnEditCountyOnClick(id, name) {
        console.log('Edit county clicked:', id, name);
    
       
        const editorIdField = document.getElementById('id');
        const editorNameField = document.getElementById('name');
    
        if (editorIdField && editorNameField) {
            editorIdField.value = id;  
            editorNameField.value = name;  // Edit County - Populate fields and show the editor
            function btnEditCountyOnClick(id, name) {
                console.log('Edit county clicked:', id, name);
            
                // Populate the editor fields with the county data
                const editorIdField = document.getElementById('id');
                const editorNameField = document.getElementById('name');
                const editorTitle = document.getElementById('editor-title');
            
                if (editorIdField && editorNameField) {
                    editorIdField.value = id;  // Set the county ID
                    editorNameField.value = name;  // Set the county name
                }
            
                // Switch editor forms: Show edit form and hide add form
                document.getElementById('county-editor').style.display = 'block';
                document.getElementById('new-county-editor').style.display = 'none';
                editorTitle.textContent = 'Edit County';  // Set form title to "Edit County"
            }
            
            // Add New County - Reset fields and show the editor
            function btnAddNewCounty() {
                console.log('Add new county clicked');
            
                // Reset fields in the form
                const editorIdField = document.getElementById('new-id');
                const editorNameField = document.getElementById('new-name');
            
                if (editorIdField && editorNameField) {
                    editorIdField.value = '';  // Reset the ID field (no ID for new county)
                    editorNameField.value = '';  // Reset the name field
                }
            
                // Switch editor forms: Show add form and hide edit form
                document.getElementById('county-editor').style.display = 'none';
                document.getElementById('new-county-editor').style.display = 'block';
                document.getElementById('new-county-title').textContent = 'Add New County';  // Set form title to "Add New County"
            }
            
            // Cancel Edit - Hide the editor
            function cancelEdit() {
                document.getElementById('county-editor').style.display = 'none';
            }
            
            // Cancel Add - Hide the editor
            function cancelAdd() {
                document.getElementById('new-county-editor').style.display = 'none';
            }
            
        } else {
            console.log('Editor fields not found!');
        }
    
        
        const editorContainer = document.getElementById('county-editor');
        if (editorContainer) {
            editorContainer.style.display = 'block';
        } else {
            console.log('Editor container not found!');
        }
    }
    
    
    function cancelEdit() {
        const editorContainer = document.getElementById('county-editor');
        if (editorContainer) {
            editorContainer.style.display = 'none';  
        }
    }
    