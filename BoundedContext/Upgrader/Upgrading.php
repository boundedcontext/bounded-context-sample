<?php namespace BoundedContext\Upgrader;

trait Upgrading
{

    private function get_function_name($version)
    {
        return 'when_version_' . $version;
    }
    
    protected function add_property($key, $value = null)
    {
        $this->payload->$key = $value;
    }
    
    protected function change_property($old_key, $new_key)
    {
        $this->payload->$key = $value;
    }
    
    protected function remove_property($key)
    {
        $this->payload->$key = $value;
    }

    protected function upgrade()
    {

        $function = $this->get_function_name($this->version);

        if (!method_exists($this, $function)) {
            throw new \Exception('A upgrade handler could not be found.');
        }

        $this->$function();

        $this->version += 1;
    }

    public function can_upgrade()
    {
        $function = $this->get_function_name($this->version);

        return method_exists($this, $function);
    }

    public function version()
    {
        return $this->version;
    }
}
