<?php

namespace Joseph\RepositoryService\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryService extends GeneratorCommand
{
    protected $signature = 'make:repository-service {name}';
    protected $description = 'Create repository and service interfaces and classes';

    protected function getStub()
    {
        // You can create stub files for the interface and class templates.
        // For now, return null because we are generating it manually.
        return null;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        // Returns the default namespace for the generated classes
        return $rootNamespace . '\Repositories';
    }

    public function handle()
    {
        // Get the name argument (e.g., "User")
        $name = $this->argument('name');

        // Create the repository interface and class
        $this->createRepositoryInterface($name);
        $this->createRepositoryClass($name);

        // Create the service interface and class
        $this->createServiceInterface($name);
        $this->createServiceClass($name);

        // Inform the user that the process is complete
        $this->info("Repository and Service files for {$name} created successfully.");
    }

    protected function createRepositoryInterface($name)
    {
        $fileName = $name . 'RepositoryInterface.php';
        $filePath = app_path('Interfaces/Repository/' . $fileName);

        if (!file_exists($filePath)) {
            $interfaceContent = "<?php\n\nnamespace App\\Interfaces\\Repository;\n\ninterface {$name}RepositoryInterface\n{\n";
            $interfaceContent .= $this->getRepositoryMethods();
            $interfaceContent .= "\n}";

            file_put_contents($filePath, $interfaceContent);
            $this->info("Repository interface created at {$filePath}");
        } else {
            $this->error("Repository interface {$fileName} already exists.");
        }
    }

    protected function createRepositoryClass($name)
    {
        $fileName = $name . 'Repository.php';
        $filePath = app_path('Repositories/' . $fileName);

        if (!file_exists($filePath)) {
            $repositoryContent = "<?php\n\nnamespace App\\Repositories;\n\nuse App\\Interfaces\\Repository\\{$name}RepositoryInterface;\n\nclass {$name}Repository implements {$name}RepositoryInterface\n{\n";
            $repositoryContent .= $this->getRepositoryMethodsImplementation();
            $repositoryContent .= "\n}";

            file_put_contents($filePath, $repositoryContent);
            $this->info("Repository class created at {$filePath}");
        } else {
            $this->error("Repository class {$fileName} already exists.");
        }
    }

    protected function createServiceInterface($name)
    {
        $fileName = $name . 'ServiceInterface.php';
        $filePath = app_path('Interfaces/Service/' . $fileName);

        if (!file_exists($filePath)) {
            $serviceInterfaceContent = "<?php\n\nnamespace App\\Interfaces\\Service;\n\ninterface {$name}ServiceInterface\n{\n";
            $serviceInterfaceContent .= $this->getServiceMethods();
            $serviceInterfaceContent .= "\n}";

            file_put_contents($filePath, $serviceInterfaceContent);
            $this->info("Service interface created at {$filePath}");
        } else {
            $this->error("Service interface {$fileName} already exists.");
        }
    }

    protected function createServiceClass($name)
    {
        $fileName = $name . 'Service.php';
        $filePath = app_path('Services/' . $fileName);

        if (!file_exists($filePath)) {
            $serviceClassContent = "<?php\n\nnamespace App\\Services;\n\nuse App\\Interfaces\\Service\\{$name}ServiceInterface;\n\nclass {$name}Service implements {$name}ServiceInterface\n{\n";
            $serviceClassContent .= $this->getServiceMethodsImplementation();
            $serviceClassContent .= "\n}";

            file_put_contents($filePath, $serviceClassContent);
            $this->info("Service class created at {$filePath}");
        } else {
            $this->error("Service class {$fileName} already exists.");
        }
    }

    protected function getRepositoryMethods()
    {
        // Define the methods for the Repository Interface
        return "
    public function findMany(object \$payload, string \$sortField, string \$sortOrder);
    public function findByUuid(string \$uuid);
    public function findById(int \$id);
    public function create(object \$payload);
    public function update(object \$payload, string \$uuid);
    public function delete(string \$uuid);
        ";
    }

    protected function getRepositoryMethodsImplementation()
    {
        // Define the basic method implementations for the Repository Class
        return "
            public function findMany(object \$payload, string \$sortField, string \$sortOrder)
            {
                // Implement method logic
            }

            public function findByUuid(string \$uuid)
            {
                // Implement method logic
            }

            public function findById(int \$id)
            {
                // Implement method logic
            }

            public function create(object \$payload)
            {
                // Implement method logic
            }

            public function update(object \$payload, string \$uuid)
            {
                // Implement method logic
            }

            public function delete(string \$uuid)
            {
                // Implement method logic
            }
        ";
    }

    protected function getServiceMethods()
    {
        // Define the methods for the Service Interface
        return "
            public function handleRequest(object \$request);
            public function processData(object \$data);
        ";
    }

    protected function getServiceMethodsImplementation()
    {
        // Define the basic method implementations for the Service Class
        return "
    public function handleRequest(object \$request)
    {
        // Implement method logic
    }

    public function processData(object \$data)
    {
        // Implement method logic
    }
        ";
    }
}
