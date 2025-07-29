# QuickData for Laravel 5

Basic functions for easier CRUD management with entities, controllers and repositories for Laravel 5.

### Controllers
`use HasJsonCRUD;`
JSON response methods for CRUD, filter, and auto-relationship sync.

### Repositories
`DataRepositoryInterface`
The interface to be implemented by data repositories.

`BaseRepository`
Default implementation of `DataRepositoryInterface`. Extend your repositories from this abstract class or create your own.

### Models
```
use RelationshipDataTrait;
```
Models must use this trait for the controller to auto-sync related models.

```
use SearchableTrait;
```
Use this trait to make models searchable by given fields.

### Search Filters
Where Clause

Now where clause is capable of creating eloquent query by passing operator as the 2nd parameter. As following code,
```
public function where($column, $operator, $value = null)
    {
        $args = func_get_args();
        if(!is_null($column)){
            if(func_num_args() == 2) {
                $this->attributes['where'][] = ["key"=>$args[0],"value" => $args[1],'operator'=>"="];
            } elseif(func_num_args() == 3) {
                $this->attributes['where'][] = ["key"=>$args[0],"value" => $args[2],'operator'=> $args[1]];
            } elseif (func_num_args() == 1) {
                throw New \Exception("Must have at least 2 parameters");
            }
        }

    }
``` 
Here the column is table column, operators can be = , < , > , <= , >= and the value.