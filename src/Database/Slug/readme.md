### Database: Slug

Easily integrated slug into eloquent model.

----
#### Usage

Just implement `HasSlugInterface` and use `HasSlug` trait into your eloquent model.

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