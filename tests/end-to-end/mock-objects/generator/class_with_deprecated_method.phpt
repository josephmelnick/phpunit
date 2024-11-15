--TEST--
\PHPUnit\Framework\MockObject\Generator\Generator::generate('ClassWithDeprecatedMethod', [], 'MockFoo', TRUE, TRUE)
--FILE--
<?php declare(strict_types=1);
class ClassWithDeprecatedMethod
{
    /**
     * @deprecated this method
     *             is deprecated
     */
    public function deprecatedMethod()
    {
    }
}

require_once __DIR__ . '/../../../bootstrap.php';

$generator = new \PHPUnit\Framework\MockObject\Generator\Generator;

$mock = $generator->generate(
  type: 'ClassWithDeprecatedMethod',
  mockObject: true,
  methods: [],
  mockClassName: 'MockFoo',
);

print $mock->classCode();
--EXPECT--
declare(strict_types=1);

class MockFoo extends ClassWithDeprecatedMethod implements PHPUnit\Framework\MockObject\MockObjectInternal
{
    use PHPUnit\Framework\MockObject\StubApi;
    use PHPUnit\Framework\MockObject\MockObjectApi;
    use PHPUnit\Framework\MockObject\Method;
    use PHPUnit\Framework\MockObject\DoubledCloneMethod;

    public function deprecatedMethod()
    {
        @trigger_error('The ClassWithDeprecatedMethod::deprecatedMethod method is deprecated (this method is deprecated).', E_USER_DEPRECATED);

        $__phpunit_definedVariables        = get_defined_vars();
        $__phpunit_namedVariadicParameters = [];

        foreach ($__phpunit_definedVariables as $__phpunit_definedVariableName => $__phpunit_definedVariableValue) {
            if ((new ReflectionParameter([__CLASS__, __FUNCTION__], $__phpunit_definedVariableName))->isVariadic()) {
                foreach ($__phpunit_definedVariableValue as $__phpunit_key => $__phpunit_namedValue) {
                    if (is_string($__phpunit_key)) {
                        $__phpunit_namedVariadicParameters[$__phpunit_key] = $__phpunit_namedValue;
                    }
                }
            }
        }

        $__phpunit_arguments = [];
        $__phpunit_count     = func_num_args();

        if (0 !== null && $__phpunit_count > 0) {
            $__phpunit_arguments_tmp = func_get_args();

            for ($__phpunit_i = 0; $__phpunit_i < $__phpunit_count; $__phpunit_i++) {
                $__phpunit_arguments[] = $__phpunit_arguments_tmp[$__phpunit_i];
            }
        }

        $__phpunit_arguments = array_merge($__phpunit_arguments, $__phpunit_namedVariadicParameters);

        $__phpunit_result = $this->__phpunit_getInvocationHandler()->invoke(
            new \PHPUnit\Framework\MockObject\Invocation(
                'ClassWithDeprecatedMethod', 'deprecatedMethod', $__phpunit_arguments, '', $this
            )
        );

        return $__phpunit_result;
    }
}
