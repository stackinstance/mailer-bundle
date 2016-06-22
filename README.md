<<<<<<< HEAD
#Stack Instance Mailer bundle

## How to install
composer require stackinstance/mailer-bundle

## Usage
```PHP
/**
 * @Route("/mail", name="mail")
 */
public function mailAction()
{
    $mailer     = $this->container->get('stack_instance.mailer');
    $attachment = new Attachment();

    $attachment->attach('/path/to/file/test.csv', 'file.csv', 'text/csv');

    $mailer->send('This is my subject', 'This is the body', 'to@example.org', 'from@example.org', $attachment);
}
```

=======
#Stack Instance Api Server bundle

## How to install
composer require stackinstance/api-server-bundle

## Routing to see an example:
```YML
stack_instance_api_server:
    resource: "@StackInstanceApiServerBundle/Resources/config/routing.yml"
    prefix:   /
```

## Tables creating for the example
php app/console doctrine:schema:update --force

>>>>>>> c6f2158958aa3a4baf49bc57b8c1b2cc46118e9f
## Website
- http://bundles.stackinstance.com
- http://www.stackinstance.com
- https://codedump.io
- http://www.codetrust.nl