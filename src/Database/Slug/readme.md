### Database: Slug

Easily integrated slug into eloquent model.

----
#### Usage

Just implement `HasSlugInterface` and use `HasSlug` trait into your eloquent model, all you need to do is implementing `getSlugFrom()` to get the slug value from given attribute.

```php 
use Illuminate\Database\Eloquent\Model;
use Veelasky\Foundry\Database\Slug\HasSlugInterface;
use Veelasky\Foundry\Database\Slug\HasSlug;

class Post extends Model implements HasSlugInterface {

    use HasSlug;
    
    public function getSlugFrom()
    {
        return 'title';
    }
    
}
```

at default slug will use attribute `slug` on the designated table to store slug value, but if you want to change it you can easily change it by invoking `getSlug()` method.

```php
...
    public function getSlug()
    {
        return 'custom_slug_attribute';
    }
...
```