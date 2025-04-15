<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use TypeError;
use ArgumentCountError;
use PDOException;
use ValueError;
use ParseError;
use ArithmeticError;
use CompileError;
use DivisionByZeroError;
use UnhandledMatchError;

use Illuminate\Auth\Access\AuthorizationException;

// A. Vendor - Laravel - Framework - src - Illuminate
    // 1. Authentication
    use Illuminate\Auth\AuthenticationException;

    // 2. Broadcasting
    use Illuminate\Broadcasting\BroadcastException;

    // 3. Collections
    use Illuminate\Support\ItemNotFoundException;
    use Illuminate\Support\MultipleItemsFoundException;

    // 4. Console
    use Illuminate\Console\PromptValidationException;

    // 5. Container
    use Illuminate\Container\EntryNotFoundException;

    // 6. Contracts
    use Illuminate\Contracts\Cache\LockTimeoutException;
    use Illuminate\Contracts\Container\BindingResolutionException;
    use Illuminate\Contracts\Container\CircularDependencyException;

    // 7. Encryption
    use Illuminate\Contracts\Encryption\DecryptException;
    use Illuminate\Contracts\Encryption\EncryptException;

    // 8. Filesystem
    use Illuminate\Contracts\Filesystem\FileNotFoundException;
    use Illuminate\Contracts\Filesystem\LockTimeoutException as FilesystemLockTimeoutException;

    // 9. Queue
    use Illuminate\Contracts\Queue\EntityNotFoundException;

    // 10. Redis
    use Illuminate\Contracts\Redis\LimiterTimeoutException;

    // 11. View
    use Illuminate\Contracts\View\ViewCompilationException;

    // 12. Database - Eloquent
    use Illuminate\Database\Eloquent\InvalidCastException;
    use Illuminate\Database\Eloquent\JsonEncodingException;
    use Illuminate\Database\Eloquent\MassAssignmentException;
    use Illuminate\Database\Eloquent\MissingAttributeException;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Database\Eloquent\RelationNotFoundException;

    // 13. Database
    use Illuminate\Database\ClassMorphViolationException;
    use Illuminate\Database\DeadlockException;
    use Illuminate\Database\LazyLoadingViolationException;
    use Illuminate\Database\LostConnectionException;
    use Illuminate\Database\MultipleColumnsSelectedException;
    use Illuminate\Database\MultipleRecordsFoundException;
    use Illuminate\Database\QueryException;
    use Illuminate\Database\RecordsNotFoundException;
    use Illuminate\Database\SQLiteDatabaseDoesNotExistException;
    use Illuminate\Database\UniqueConstraintViolationException;
    use Illuminate\Encryption\MissingAppKeyException;
    use Illuminate\Foundation\Bootstrap\HandleExceptions;
    use Illuminate\Foundation\ViteManifestNotFoundException;
    use Illuminate\Http\Client\ConnectionException;
    use Illuminate\Http\Client\HttpClientException;
    use Illuminate\Http\Client\RequestException;
    use Illuminate\Http\Exceptions\HttpResponseException;
    use Illuminate\Http\Exceptions\PostTooLargeException;
    use Illuminate\Http\Exceptions\ThrottleRequestsException;

    use Illuminate\Process\Exceptions\ProcessFailedException;
    use Illuminate\Process\Exceptions\ProcessTimedOutException;
    use Illuminate\Queue\Events\JobReleasedAfterException;
    use Illuminate\Queue\Middleware\ThrottlesExceptions;
    use Illuminate\Queue\InvalidPayloadException;
    use Illuminate\Queue\ManuallyFailedException;
    use Illuminate\Queue\MaxAttemptsExceededException;
    use Illuminate\Queue\TimeoutExceededException;

    use Illuminate\Routing\Exceptions\BackedEnumCaseNotFoundException;
    use Illuminate\Routing\Exceptions\InvalidSignatureException as RoutingInvalidSignatureException;
    use Illuminate\Routing\Exceptions\StreamedResponseException;
    use Illuminate\Routing\Exceptions\UrlGenerationException;

    use Illuminate\Session\TokenMismatchException;

    use Illuminate\Support\Exceptions\MathException;
    use Illuminate\Support\Exceptions\StringableException;
    use Illuminate\Support\Exceptions\UnwrapThrowableException;

    use Illuminate\Testing\Exceptions\InvalidArgumentException;

    use Illuminate\Validation\Concerns\FilterEmailValidation;
    use Illuminate\Validation\UnauthorizedException;
    use Illuminate\Validation\ValidationException as IlluminateValidationException;
    use Illuminate\View\ViewException;

// B. Vendor - Laravel - Others
use Laravel\Prompts\Exceptions\FormRevertedException;
use Laravel\Prompts\Exceptions\NonInteractiveValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Laravel\Sanctum\Exceptions\MissingScopeException;
use Laravel\SerializableClosure\Exceptions\InvalidSignatureException as SerializableClosureInvalidSignatureException;
use Laravel\SerializableClosure\Exceptions\MissingSecretKeyException;
use Laravel\SerializableClosure\Exceptions\PhpVersionNotSupportedException;

// C. Vendor - League
use League\CommonMark\Exception\AlreadyInitializedException;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\Exception\InvalidArgumentException as LeagueInvalidArgumentException;
use League\CommonMark\Exception\IOException;

use League\CommonMark\Exception\LogicException;
use League\CommonMark\Exception\MissingDependencyException;
use League\CommonMark\Exception\UnexpectedEncodingException;

use League\CommonMark\Extension\FrontMatter\Exception\InvalidFrontMatterException;
use League\CommonMark\Parser\ParserLogicException;
use League\CommonMark\Renderer\NoMatchingRendererException;

use League\Config\Exception\InvalidConfigurationException;
use League\Config\Exception\UnknownOptionException;
use League\Config\Exception\ValidationException as LeagueValidationException;

use League\Flysystem\FilesystemException;

// D. Vendor - Mockery
use Mockery\CountValidator\Exception as MockeryCountValidatorException;
use Mockery\Exception\BadMethodCallException;
use Mockery\Exception\InvalidArgumentException as MockeryInvalidArgumentException;
use Mockery\Exception\InvalidCountException;
use Mockery\Exception\InvalidOrderException;
use Mockery\Exception\NoMatchingExpectationException;
use Mockery\Exception\RuntimeException as MockeryRuntimeException;

use Monolog\Handler\MissingExtensionException;

use DeepCopy\Exception\CloneException;
use DeepCopy\Exception\PropertyException;

use Carbon\Exceptions\BadComparisonUnitException;
use Carbon\Exceptions\BadFluentConstructorException;
use Carbon\Exceptions\BadFluentSetterException;
use Carbon\Exceptions\BadMethodCallException as CarbonBadMethodCallException;

use Carbon\Exceptions\EndLessPeriodException;
use Carbon\Exceptions\ImmutableException;
use Carbon\Exceptions\InvalidArgumentException as CarbonInvalidArgumentException;
use Carbon\Exceptions\InvalidCastException as CarbonInvalidCastException;
use Carbon\Exceptions\InvalidDateException;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\InvalidIntervalException;
use Carbon\Exceptions\InvalidPeriodDateException;
use Carbon\Exceptions\InvalidPeriodParameterException;
use Carbon\Exceptions\InvalidTimeZoneException;
use Carbon\Exceptions\InvalidTypeException;
use Carbon\Exceptions\NotACarbonClassException;
use Carbon\Exceptions\NotAPeriodException;
use Carbon\Exceptions\NotLocaleAwareException;
use Carbon\Exceptions\OutOfRangeException;
use Carbon\Exceptions\ParseErrorException;
use Carbon\Exceptions\RuntimeException as CarbonRuntimeException;
use Carbon\Exceptions\UnitException;
use Carbon\Exceptions\UnitNotConfiguredException;
use Carbon\Exceptions\UnknownGetterException;
use Carbon\Exceptions\UnknownMethodException as CarbonUnknownMethodException;
use Carbon\Exceptions\UnknownSetterException;
use Carbon\Exceptions\UnknownUnitException;
use Carbon\Exceptions\UnreachableException;

// E. Vendor - Nette
use Nette\Schema\ValidationException as NetteValidationException;
use Nette\ArgumentOutOfRangeException as NetteArgumentOutOfRangeException;
use Nette\InvalidStateException as NetteInvalidStateException;
use Nette\NotImplementedException as NetteNotImplementedException;
use Nette\NotSupportedException as NetteNotSupportedException;
use Nette\DeprecatedException as NetteDeprecatedException;
use Nette\MemberAccessException as NetteMemberAccessException;
use Nette\IOException as NetteIOException;
use Nette\FileNotFoundException as NetteFileNotFoundException;
use Nette\DirectoryNotFoundException as NetteDirectoryNotFoundException;
use Nette\InvalidArgumentException as NetteInvalidArgumentException;
use Nette\OutOfRangeException as NetteOutOfRangeException;
use Nette\UnexpectedValueException as NetteUnexpectedValueException;

// F. Vendor - PhpParser
use PhpParser\ConstExprEvaluationException;

// G. Vendor - NunoMaduro
use NunoMaduro\Collision\Adapters\Laravel\Exceptions\NotSupportedYetException;
use NunoMaduro\Collision\Adapters\Laravel\Exceptions\RequirementsException;
use NunoMaduro\Collision\Exceptions\InvalidStyleException;

// H. Vendor - Termwind
use Termwind\Exceptions\ColorNotFound;
use Termwind\Exceptions\InvalidChild;
use Termwind\Exceptions\InvalidColor;
use Termwind\Exceptions\InvalidStyle;
use Termwind\Exceptions\StyleNotFound;

// I. Vendor - PharIo
use PharIo\Manifest\ElementCollectionException;
use PharIo\Manifest\InvalidApplicationNameException;
use PharIo\Manifest\InvalidEmailException as PharIoInvalidEmailException;
use PharIo\Manifest\InvalidUrlException;
use PharIo\Manifest\ManifestDocumentException;
use PharIo\Manifest\ManifestDocumentLoadingException;
use PharIo\Manifest\ManifestDocumentMapperException;
use PharIo\Manifest\ManifestElementException;
use PharIo\Manifest\ManifestLoaderException;
use PharIo\Manifest\NoEmailAddressException;
use PharIo\Version\InvalidPreReleaseSuffixException;
use PharIo\Version\InvalidVersionException;
use PharIo\Version\NoBuildMetaDataException;
use PharIo\Version\NoPreReleaseSuffixException;
use PharIo\Version\UnsupportedVersionConstraintException;

// J. Vendor - SebastianBergmann
use SebastianBergmann\CodeCoverage\BranchAndPathCoverageNotSupportedException;
use SebastianBergmann\CodeCoverage\DeadCodeDetectionNotSupportedException;
use SebastianBergmann\CodeCoverage\DirectoryCouldNotBeCreatedException;
use SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException;
use SebastianBergmann\CodeCoverage\InvalidArgumentException as SebastianBergmannInvalidArgumentException;
use SebastianBergmann\CodeCoverage\NoCodeCoverageDriverAvailableException;
use SebastianBergmann\CodeCoverage\NoCodeCoverageDriverWithPathCoverageSupportAvailableException;
use SebastianBergmann\CodeCoverage\ParserException;
use SebastianBergmann\CodeCoverage\PathExistsButIsNotDirectoryException;
use SebastianBergmann\CodeCoverage\PcovNotAvailableException;
use SebastianBergmann\CodeCoverage\ReflectionException;
use SebastianBergmann\CodeCoverage\ReportAlreadyFinalizedException;
use SebastianBergmann\CodeCoverage\StaticAnalysisCacheNotConfiguredException;
use SebastianBergmann\CodeCoverage\TestIdMissingException;
use SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException;
use SebastianBergmann\CodeCoverage\WriteOperationFailedException;
use SebastianBergmann\CodeCoverage\XdebugNotAvailableException;
use SebastianBergmann\CodeCoverage\XdebugNotEnabledException;
use SebastianBergmann\CodeCoverage\XmlException;

// K. Vendor - PhpUnit - Invoker
use SebastianBergmann\Invoker\ProcessControlExtensionNotLoadedException;
use SebastianBergmann\Invoker\TimeoutException as InvokerTimeoutException;
use SebastianBergmann\Template\InvalidArgumentException as TextTemplateInvalidArgumentException;
use SebastianBergmann\Template\RuntimeException as TextTemplateRuntimeException;

use SebastianBergmann\Timer\NoActiveTimerException;
use SebastianBergmann\Timer\TimeSinceStartOfRequestNotAvailableException;

// L. Vendor - PhpUnit - Event
use PHPUnit\Event\EventAlreadyAssignedException;
use PHPUnit\Event\EventFacadeIsSealedException;
use PHPUnit\Event\InvalidArgumentException as PHPUnitInvalidArgumentException;
use PHPUnit\Event\InvalidEventException;
use PHPUnit\Event\InvalidSubscriberException;
use PHPUnit\Event\MapError;
use PHPUnit\Event\TestData\MoreThanOneDataSetFromDataProviderException;
use PHPUnit\Event\Test\NoComparisonFailureException;
use PHPUnit\Event\TestData\NoDataSetFromDataProviderException;
use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Event\Code\NoTestCaseObjectOnCallStackException;
use PHPUnit\Event\RuntimeException as PHPUnitRuntimeException;
use PHPUnit\Event\SubscriberTypeAlreadyRegisteredException;
use PHPUnit\Event\UnknownEventException;
use PHPUnit\Event\UnknownEventTypeException;
use PHPUnit\Event\UnknownSubscriberException;
use PHPUnit\Event\UnknownSubscriberTypeException;

// M. Vendor - PhpUnit - Framework - Constraint
use PHPUnit\Framework\Constraint\Exception as PHPUnitFrameworkConstraintException;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessageIsOrContains;
use PHPUnit\Framework\Constraint\ExceptionMessageMatchesRegularExpression;

// N. Vendor - PhpUnit - Framework - Exception
use PHPUnit\Framework\ActualValueIsNotAnObjectException;
use PHPUnit\Framework\ComparisonMethodDoesNotAcceptParameterTypeException;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareExactlyOneParameterException;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareParameterTypeException;
use PHPUnit\Framework\ComparisonMethodDoesNotExistException;

use PHPUnit\Framework\SkippedTest;
use PHPUnit\Framework\SkippedTestSuiteError;
use PHPUnit\Framework\SkippedWithMessageException;


use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\CodeCoverageException;
use PHPUnit\Framework\EmptyStringException;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\GeneratorNotSupportedException;
use PHPUnit\Framework\InvalidArgumentException as PHPUnitInvalidArgumentException2;
use PHPUnit\Framework\InvalidCoversTargetException;
use PHPUnit\Framework\InvalidDataProviderException;
use PHPUnit\Framework\InvalidDependencyException;
use PHPUnit\Framework\NoChildTestSuiteException;
use PHPUnit\Framework\PhptAssertionFailedError;
use PHPUnit\Framework\ProcessIsolationException;
use PHPUnit\Framework\UnknownClassOrInterfaceException;
use PHPUnit\Framework\UnknownTypeException;
// ........

// N. Vendor - PhpUnit - Framework - MockObject
use PHPUnit\Framework\MockObject\BadMethodCallException as PHPUnitMockObjectBadMethodCallException;
use PHPUnit\Framework\MockObject\CannotUseOnlyMethodsException;
use PHPUnit\Framework\MockObject\IncompatibleReturnValueException;
use PHPUnit\Framework\MockObject\MatchBuilderNotFoundException;

// O. Vendor - PhpUnit - Metadata
use PHPUnit\Metadata\AnnotationsAreNotSupportedForInternalClassesException;
use PHPUnit\Metadata\InvalidVersionRequirementException;
use PHPUnit\Metadata\NoVersionRequirementException;
use PHPUnit\Metadata\ReflectionException as PHPUnitMetadataReflectionException;

// P. Vendor - PhpUnit - Runner
use PHPUnit\Runner\ClassCannotBeFoundException;
use PHPUnit\Runner\ClassDoesNotExtendTestCaseException;
use PHPUnit\Runner\ClassIsAbstractException;
use PHPUnit\Runner\DirectoryDoesNotExistException;
use PHPUnit\Runner\ErrorException;
use PHPUnit\Runner\FileDoesNotExistException;
use PHPUnit\Runner\InvalidOrderException as PHPUnitRunnerInvalidOrderException;
use PHPUnit\Runner\InvalidPhptFileException;
use PHPUnit\Runner\ParameterDoesNotExistException;
use PHPUnit\Runner\PhptExternalFileCannotBeLoadedException;
use PHPUnit\Runner\UnsupportedPhptSectionException;

// Q. Vendor - PhpUnit - TextUI
use PHPUnit\TextUI\CannotOpenSocketException;
use PHPUnit\TextUI\InvalidSocketException;
use PHPUnit\TextUI\RuntimeException;
use PHPUnit\TextUI\TestDirectoryNotFoundException;
use PHPUnit\TextUI\TestFileNotFoundException;

// R. Vendor - PhpUnit - Util
use PHPUnit\Util\InvalidDirectoryException;
use PHPUnit\Util\InvalidJsonException;
use PHPUnit\Util\InvalidVersionOperatorException;
use PHPUnit\Util\PhpProcessException;
use PHPUnit\Util\XmlException as PHPUnitUtilXmlException;

// S. Vendor - Psr
use Psr\Log\InvalidArgumentException as PsrInvalidArgumentException;
use Psr\SimpleCache\InvalidArgumentException as SimpleCacheInvalidArgumentException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Always return JSON for API requests
        if ($request->is('api/*') || $request->expectsJson()) {
            $statusCode = $this->getStatusCode($exception);
            
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $statusCode
            ], $statusCode);
        }

        return parent::render($request, $exception);
    }

    /**
     * Get appropriate status code for exception
     *
     * @param Throwable $e
     * @return int
     */
    private function getStatusCode(Throwable $e): int
    {
        // Database errors
        if ($e instanceof PDOException || $e instanceof QueryException) {
            return 500; // Internal Server Error
        }

        // Client errors (400 Bad Request)
        if ($e instanceof \InvalidArgumentException || 
            $e instanceof TypeError || 
            $e instanceof ArgumentCountError ||
            $e instanceof ValueError ||
            $e instanceof ArithmeticError ||
            $e instanceof DivisionByZeroError ||
            $e instanceof UnhandledMatchError) {
            return 400; // Bad Request
        }

        // Parse and Compile errors
        if ($e instanceof ParseError || $e instanceof CompileError) {
            return 500; // Internal Server Error
        }

        // Authentication errors
        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return 401; // Unauthorized
        }

        // Authorization errors
        if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return 403; // Forbidden
        }

        // Not found errors
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return 404; // Not Found
        }

        // Default to 500 if no specific status code is found
        return 500;
    }
}
