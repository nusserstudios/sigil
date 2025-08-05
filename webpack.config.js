const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    optimization: {
        ...defaultConfig.optimization,
        moduleIds: 'deterministic',
        chunkIds: 'deterministic',
        sideEffects: false,
        usedExports: true,
        providedExports: true,
    },
    cache: {
        type: 'filesystem',
        buildDependencies: {
            config: [__filename],
        },
        cacheDirectory: require('path').resolve(__dirname, 'node_modules/.cache/webpack'),
    },
    resolve: {
        ...defaultConfig.resolve,
        cacheWithContext: false,
    },
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules.map(rule => {
                // Add caching for JavaScript files
                if (rule.test && rule.test.toString().includes('js|jsx|ts|tsx')) {
                    return {
                        ...rule,
                        use: Array.isArray(rule.use) ? rule.use.map(use => {
                            if (typeof use === 'object' && use.loader && use.loader.includes('babel-loader')) {
                                return {
                                    ...use,
                                    options: {
                                        ...use.options,
                                        cacheDirectory: true,
                                        cacheCompression: false,
                                    }
                                };
                            }
                            return use;
                        }) : rule.use
                    };
                }
                return rule;
            })
        ]
    },
    stats: {
        // Reduce the verbosity of build output
        chunks: false,
        modules: false,
        children: false,
        warnings: false,
    }
}; 