# Enqueue bundle

Enqueue bundle, add a message consumer in your bundle.

# Instalation

(optional) Install [glynn-admin-symfony4](https://github.com/disjfa/glynn-admin-symfony4)

## Add bundle

```
composer req disjfa/enqueue-bundle
```

## Setup a enqueue dns in your .env

In your `.env` file a dns can be setup. A test setup can be used like your mysql database.

```
###> enqueue/enqueue-bundle ###
ENQUEUE_DSN=mysql://user:password@localhost:3306/database
###< enqueue/enqueue-bundle ###
```

## Routes

Add a route file `config/routes/disjfa_enqueue.yaml`, of append your route file.

```yaml
disjfa_enqueue:
    resource: '@DisjfaEnqueueBundle/Controller/'
    type:     annotation
```

## Don't forget to have fun

Did i mention you are a lovely person, now enjoy! Have fun, play and finish a puzzle! Also, don't forget to tell me if you enjoy the puzzle.