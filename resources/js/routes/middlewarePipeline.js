export default function middlewarePipeline(context,middleware,index) {
    const Middleware = middleware[index];
    if (!Middleware) {
        return context.next;
    }
    else
    {
        Middleware(context);
    }
    middlewarePipeline(context,middleware,index+1);
}
