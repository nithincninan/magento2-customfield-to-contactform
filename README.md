# Magento 2.3 - Add Custom fields to ContactForm(Dropdown,Text) + Custom Contactus Email

Magento 2.3 - Add Custom fields to Contact Form.

1. Add Custom Fields:<br />

    1.1 FirstName, LastName(Text)<br />
    1.2 Subject(Dropdown)<br />
    
2. Add validations for Custom Fields
3. Override Magento_Contact Controller
4. Source Model For Dropdown + ViewModel
5. Data patch for Custom Email(ContactUs)
6. Custom ContactUs email (Note: Assign custom contact us email to Magento Config Settings)<br />

<b>Module: Module_Contact<br />
Url: contact/index/index <br />
    
tree /F
```|-- README.md
───Module
    └───Contact
        │   registration.php
        │
        ├───Controller
        │   └───Index
        │           Post.php
        │
        ├───etc
        │   │   config.xml
        │   │   module.xml
        │   │
        │   └───frontend
        │           di.xml
        │
        ├───Model
        │   └───Config
        │       └───Source
        │               Subject.php
        │
        ├───Setup
        │   └───Patch
        │       └───Data
        │               CreateModuleContactEmail.php
        │
        ├───view
        │   └───frontend
        │       ├───email
        │       │       module_submitted_form.html
        │       │
        │       ├───layout
        │       │       contact_index_index.xml
        │       │
        │       └───templates
        │               form.phtml
        │
        └───ViewModel
                ContactForm.php
```
