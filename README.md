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
- http://www.stackinstance.com
- http://www.raymondkootstra.nl
