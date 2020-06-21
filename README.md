# Archistar API

* Create .env from .env.example, update DB connection data, artisan migrate and run
* API endpoints are listed below
* Time taken: Close to 8 hours

### Summary API
```
GET http://api.archi.test/api/property/summary?suburb=parramatta

{
    "summary": [
        {
            "max": "970",
            "min": "1.07455818832434",
            "median": 229.62953101973142,
            "total": 32
        }
    ]
}

```
### Add Property Analytics API

```
POST http://api.archi.test/api/property/add?property_id=2&value=245&analytic_types_id=3
{
    "property_analytics_id": 221,
    "msg": "successfully created"
}
```
### Update Property Analytics API

```
POST http://api.archi.test/api/property/update?property_id=2&analytic_types_id=3
{
    "property_analytics_id": 221,
    "msg": "successfully updated"
}
```
### 
## Project setup
```
composer install
```
