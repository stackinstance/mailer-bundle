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

    $mailer->send('This is my subject', 'This is the body', 'to@example.org', 'from@example.org', 'cc@address.com', 'bcc@address.com', $attachment);
}
```

## Website
- http://www.raymondkootstra.nl

## PHP requirements
As of version 2.0.2 the Stack Instance Mailer bundle needs a minimum of php 7.0.0
