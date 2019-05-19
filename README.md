# Magento 2.3 - Add Custom fields to Contact Form(Dropdown,Text) + Custom Contactus Email

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
    
Tree:
```|-- README.md
--Module
    └───Contact
        ├───Controller
        │   └───Index
        ├───etc
        │   └───frontend
        ├───Model
        │   └───Config
        │       └───Source
        ├───Setup
        │   └───Patch
        │       └───Data
        ├───view
        │   └───frontend
        │       ├───email
        │       ├───layout
        │       └───templates
        └───ViewModel
```        
