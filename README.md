# Magento Import Products Categories
A simple and ugly, but functional, script for [Magento](https://magento.com/).

:warning: **Tested only in Magento ver 1.9.3.4**

## Why Do I Need This?
If you need to update your product categories in Magento and you have a lot of products, it will probably be a lot of work. So with this script, you can do this directly in the database.

You only need the **sku** of the product and the **category_id** of the category you want to link to the product. Then, create/generate a *CSV file* with this information.

## How Do I Use This?
In `index.php` just follow the steps below...

**Change your database connection config:**
```diff
- $conn = new mysqli('localhost', 'user', 'password', 'database');
+ $conn = new mysqli('your_host', 'your_user', 'your_password', 'your_database');
```

**Change your database prefix:**
```diff
- $db_prefix = 'mage_';
+ $db_prefix = 'your_prefix';
```

**(Optional) Change your file name:**
```diff
- $file = fopen('productsCategories.csv', 'r');
+ $file = fopen('your_file_name.csv', 'r');
```

**Now run your script!**

# :warning: Note
This script will **delete** all the links of your products with your categories, then create the links according to your *CSV file*, which should follow the pattern `"SKU","category_id"`, as below.
```csv
"4951603600100101000100","4"
"4951603600100101000100","5"
"4951603600100101000100","6"
"4951603600100101000100","7"
"7503500200200201000100","4"
```

# License
[WTFPL](http://www.wtfpl.net/)
