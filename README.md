Project uses [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser/) for parsing code.

## Usage
```
composer install
php bin/php-oo-stats.php /var/www/app
```


Stats are written into JSON file in `/var`

## Example output

```json
{
  "use": {
    "Collection": 97,
    "Service": 60,
    "AppResolver": 48,
    "Request": 47,
    "Model": 43,
    "Component": 42,
    "CompanyId": 39,
    "Controller": 39,
    "OA": 37,
    "Lock": 1,
    "LockProvider": 1,
    "CacheContract": 1,
    "CacheBasedSessionHandler": 1,
    "ReloadsModel": 1,
    "EntryNotFoundException": 1,
    "NestedItems": 1,
    "Logger": 1,
    "RedisStore": 1,
    "ConnectionException": 1
  },
  "namespace": {
    "WebSupport_Admin_Repositories_Frm": 19,
    "WebSupport_Admin_Repositories_Frm_Mapping": 18,
    "WebSupport_Admin_Http_Middleware": 16,
    "WebSupport_Admin_Modules_Hosting_Repositories": 16,
    "WebSupport_Admin_Services_Api_ElasticSearch_Model": 14,
    "WebSupport_Admin_Providers": 14,
    "WebSupport_Admin_Modules_Hosting_View_Components": 14,
    "WebSupport_Admin_Models_FrmDb_Search": 13,
    "WebSupport_Admin_Modules_Hosting_Http_Requests_Hosting": 12,
    "WebSupport_Admin_Modules_Service_Repositories": 12,
    "WebSupport_Admin_Modules_Hosting_Rules": 11
  },
  "class": {
    "WebSupport_Admin_Repositories_HostingService_AssignmentServiceMapping": 1,
    "WebSupport_Admin_Repositories_HostingService_HostingServiceDataProvidingListener": 1,
    "WebSupport_Admin_Repositories_HostingService_HostingServiceMapping": 1,
    "WebSupport_Admin_Repositories_HostingService_AssignmentServiceRepository": 1,
    "WebSupport_Admin_Repositories_HostingService_AssignmentServiceDataProvidingListener": 1,
    "WebSupport_Admin_Repositories_HostingService_HostingServiceRepository": 1,
    "WebSupport_Admin_Repositories_ServicesService_ServicesServiceRepository": 1,
    "WebSupport_Admin_Repositories_ServicesService_ServicesServiceMapping": 1,
    "WebSupport_Admin_Repositories_ServicesService_ServicesServiceDataProvidingListener": 1
  },
  "total": {
    "use": 19,
    "namespace": 11,
    "class": 9
  }
}
```
